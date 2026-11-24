<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use BackedEnum;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use Symfony\Component\Yaml\Yaml;

/**
 * Checks the client against the committed snapshot of the Enhance OpenAPI
 * specification (resources/specs/oas3-api.yaml): every operation has a method
 * with the same route and query parameters, every schema an operation uses has
 * a DTO with the same properties or an enum with the same cases.
 *
 * The scheduled spec-drift workflow refreshes the snapshot; when Enhance adds
 * or changes something, this test names what the client lacks.
 */
#[CoversNothing]
final class SpecTest extends TestCase
{
    private const string SNAPSHOT = __DIR__ . '/../../resources/specs/oas3-api.yaml';

    /**
     * Operations the client leaves out on purpose (see docs/README.md, "Not covered").
     */
    private const array NOT_COVERED = ['manifestCallback', 'installComplete', 'githubWebhook'];

    /**
     * Schemas whose class has a different name.
     */
    private const array CLASS_NAMES = ['Unset' => 'UnsetType'];

    /**
     * Enum cases the API returns although the specification does not list them.
     */
    private const array EXTRA_ENUM_CASES = ['ResourceName' => ['processes']];

    /** @var array<string, mixed>|null */
    private static ?array $spec = null;

    /** @var array<string, array{method: string, path: string, function: ReflectionMethod}>|null */
    private static ?array $methods = null;

    public function testTheReadmeNamesTheVersionOfTheSnapshot(): void
    {
        $version = self::spec()['info']['version'];

        self::assertStringContainsString("(v{$version})", (string)file_get_contents(__DIR__ . '/../../README.md'));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function operations(): iterable
    {
        foreach (array_keys(self::operationIndex()) as $operationId) {
            if (! \in_array($operationId, self::NOT_COVERED, true)) {
                yield $operationId => [$operationId];
            }
        }
    }

    #[DataProvider('operations')]
    public function testTheOperationHasAMethodWithItsRouteAndQueryParameters(string $operationId): void
    {
        $operation = self::operationIndex()[$operationId];
        $method = self::methodIndex()[$operationId] ?? null;

        self::assertNotNull($method, "No method links to {$operationId} ({$operation['method']} {$operation['path']})");
        self::assertSame("{$operation['method']} {$operation['path']}", "{$method['method']} {$method['path']}", "Route of {$operationId}");

        $parameters = array_map(static fn ($parameter): string => $parameter->getName(), $method['function']->getParameters());

        foreach ($operation['query'] as $name) {
            self::assertContains(self::camelCase($name), $parameters, "{$operationId} lacks the query parameter {$name}");
        }
    }

    public function testEveryMethodLinksToAnOperationOfTheSpecification(): void
    {
        $unknown = array_diff(array_keys(self::methodIndex()), array_keys(self::operationIndex()));

        self::assertSame([], array_values($unknown), 'Methods link to operations the specification no longer has');
    }

    public function testTheOperationsLeftOutStillExist(): void
    {
        self::assertSame([], array_values(array_diff(self::NOT_COVERED, array_keys(self::operationIndex()))));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function schemas(): iterable
    {
        $spec = self::spec();
        // Only schemas an operation or another schema refers to; the specification also defines a few unused ones.
        preg_match_all('~#/components/schemas/(\w+)~', (string)file_get_contents(self::SNAPSHOT), $match);
        $used = array_flip($match[1]);

        foreach ($spec['components']['schemas'] as $name => $schema) {
            if (isset($used[$name]) && (isset($schema['enum']) || self::properties($schema) !== [])) {
                yield $name => [$name];
            }
        }
    }

    #[DataProvider('schemas')]
    public function testTheSchemaHasAClassWithItsPropertiesOrCases(string $name): void
    {
        $schema = self::spec()['components']['schemas'][$name];
        $short = self::CLASS_NAMES[$name] ?? $name;

        if (isset($schema['enum'])) {
            $class = "GoSuccess\\Enhance\\Enum\\{$short}";
            self::assertTrue(enum_exists($class), "No enum {$class}");
            /** @var class-string<BackedEnum> $class */
            $cases = array_map(static fn (BackedEnum $case): string => (string)$case->value, $class::cases());
            $expected = array_merge(array_map('strval', $schema['enum']), self::EXTRA_ENUM_CASES[$name] ?? []);
            sort($cases);
            sort($expected);
            self::assertSame($expected, $cases, "Cases of {$class}");

            return;
        }

        $class = "GoSuccess\\Enhance\\DTO\\{$short}";
        self::assertTrue(class_exists($class), "No DTO {$class}");
        $properties = array_map(
            static fn (ReflectionProperty $property): string => $property->getName(),
            array_filter(new ReflectionClass($class)->getProperties(ReflectionProperty::IS_PUBLIC), static fn (ReflectionProperty $property): bool => ! $property->isStatic()),
        );
        $expected = array_keys(self::properties($schema));
        sort($properties);
        sort($expected);
        self::assertSame($expected, $properties, "Properties of {$class}");
    }

    /**
     * @return array<string, mixed>
     */
    private static function spec(): array
    {
        return self::$spec ??= Yaml::parseFile(self::SNAPSHOT);
    }

    /**
     * @return array<string, array{method: string, path: string, query: list<string>}>
     */
    private static function operationIndex(): array
    {
        $spec = self::spec();
        $operations = [];

        foreach ($spec['paths'] as $path => $item) {
            foreach (['get', 'post', 'put', 'patch', 'delete'] as $method) {
                if (! isset($item[$method])) {
                    continue;
                }

                $query = [];

                foreach ([...$item['parameters'] ?? [], ...$item[$method]['parameters'] ?? []] as $parameter) {
                    $parameter = self::resolve($parameter);

                    if ($parameter['in'] === 'query') {
                        $query[] = $parameter['name'];
                    }
                }

                $operations[$item[$method]['operationId']] = ['method' => strtoupper($method), 'path' => $path, 'query' => $query];
            }
        }

        return $operations;
    }

    /**
     * Resource methods keyed by the operationId their @link names.
     *
     * @return array<string, array{method: string, path: string, function: ReflectionMethod}>
     */
    private static function methodIndex(): array
    {
        if (self::$methods !== null) {
            return self::$methods;
        }

        self::$methods = [];

        foreach (glob(__DIR__ . '/../../src/Resource/*Resource.php') ?: [] as $file) {
            $name = 'GoSuccess\\Enhance\\Resource\\' . basename($file, '.php');
            self::assertTrue(class_exists($name), "{$file} does not declare {$name}");
            $class = new ReflectionClass($name);

            foreach ($class->getMethods(ReflectionMethod::IS_PUBLIC) as $function) {
                $doc = (string)$function->getDocComment();

                if (preg_match('~@link https://apidocs\.enhance\.com/#/[^/]+/(\w+)\s*\n\s*\*\s*(GET|POST|PUT|PATCH|DELETE) (\S+)~', $doc, $match) === 1) {
                    self::$methods[$match[1]] = ['method' => $match[2], 'path' => $match[3], 'function' => $function];
                }
            }
        }

        return self::$methods;
    }

    /**
     * @param array<string, mixed> $schema
     * @return array<string, mixed>
     */
    private static function properties(array $schema): array
    {
        $properties = $schema['properties'] ?? [];

        foreach ($schema['allOf'] ?? [] as $part) {
            $properties += self::resolve($part)['properties'] ?? [];
        }

        return $properties;
    }

    /**
     * @param array<string, mixed> $node
     * @return array<string, mixed>
     */
    private static function resolve(array $node): array
    {
        if (! isset($node['$ref'])) {
            return $node;
        }

        [, , $section, $name] = explode('/', $node['$ref']);

        return self::spec()['components'][$section][$name];
    }

    private static function camelCase(string $name): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $name))));
    }
}
