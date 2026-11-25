<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use BackedEnum;
use DateTimeImmutable;
use GoSuccess\Enhance\Attribute\ArrayItemType;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionProperty;
use Symfony\Component\Yaml\Yaml;

/**
 * Checks the client against the committed snapshot of the Enhance OpenAPI
 * specification (resources/specs/oas3-api.yaml).
 *
 * For every operation, the method that links to it must send the request the
 * specification describes: the HTTP method and path of the actual request
 * call, exactly the query keys of the operation, a body exactly when the
 * operation takes one (typed as its schema), and a return type that matches
 * the response. For every schema an operation uses, the DTO must have the
 * same properties with matching types, or the enum the same cases.
 *
 * The scheduled spec-drift workflow refreshes the snapshot; when Enhance adds
 * or changes something, this test names what the client lacks.
 */
#[CoversNothing]
final class SpecTest extends TestCase
{
    private const string SNAPSHOT = __DIR__ . '/../../resources/specs/oas3-api.yaml';

    private const string DTO = 'GoSuccess\\Enhance\\DTO\\';

    private const string ENUM = 'GoSuccess\\Enhance\\Enum\\';

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
    public function testTheMethodSendsTheRequestOfTheOperation(string $operationId): void
    {
        $operation = self::operationIndex()[$operationId];
        $method = self::methodIndex()[$operationId] ?? null;

        self::assertNotNull($method, "No method links to {$operationId} ({$operation['method']} {$operation['path']})");

        $route = "{$operation['method']} {$operation['path']}";
        self::assertSame($route, "{$method['method']} {$method['path']}", "Documented route of {$operationId}");

        $call = self::requestCall($method['function']);
        $path = preg_replace_callback('~\{(\w+)\}~', static fn (array $match): string => '{' . self::camelCase($match[1]) . '}', $operation['path']);
        self::assertSame("{$operation['method']} {$path}", "{$call['method']} {$call['path']}", "Route {$operationId} sends");

        $parameters = array_map(static fn ($parameter): string => $parameter->getName(), $method['function']->getParameters());

        foreach ($operation['query'] as $name) {
            self::assertContains(self::camelCase($name), $parameters, "{$operationId} lacks the query parameter {$name}");
        }

        $expected = $operation['query'];
        $sent = self::queryKeys($method['function'], $call['query']);
        sort($expected);
        sort($sent);
        self::assertSame($expected, $sent, "Query keys {$operationId} sends");

        $body = $operation['body'];
        self::assertSame($body !== null, $call['body'] !== null, $body === null ? "{$operationId} takes no body" : "{$operationId} takes a body");

        if ($body === null) {
            return;
        }

        self::assertSame($body['contentType'] === 'multipart/form-data', $call['multipart'], "Content type of the body of {$operationId}");
        // A multipart body is built from the file and its name, not sent as a DTO.
        $type = self::phpTypes($body['schema'])[0];

        if (str_starts_with($type, self::DTO) && ! $call['multipart']) {
            $types = array_map(static fn ($parameter): string => self::typeName($parameter->getType()), $method['function']->getParameters());
            self::assertContains($type, $types, "{$operationId} takes a {$type} as body");
        }
    }

    #[DataProvider('operations')]
    public function testTheMethodReturnsTheResponseOfTheOperation(string $operationId): void
    {
        $operation = self::operationIndex()[$operationId];
        $method = self::methodIndex()[$operationId] ?? null;
        self::assertNotNull($method, "No method links to {$operationId}");

        $function = $method['function'];
        $returns = (string)$function->getReturnType();
        $response = $operation['response'];

        if ($response === null) {
            // No JSON body: the raw body of a download, the Location of a redirect, or a success flag.
            $accepted = $operation['rawResponse'] ? ['string', '?string'] : ($operation['redirect'] ? ['?string'] : ['bool']);
            self::assertContains($returns, $accepted, "Return type of {$operationId}");

            return;
        }

        $types = self::phpTypes($response);
        $accepted = array_map(static fn (string $type): string => \in_array($type, ['array', 'mixed'], true) ? $type : "?{$type}", $types);
        self::assertContains($returns, $accepted, "Return type of {$operationId}");

        $source = self::source($function);

        if (str_starts_with($types[0], self::DTO)) {
            self::assertStringContainsString(self::shortName($types[0]) . '::fromArray(', $source, "{$operationId} hydrates a " . self::shortName($types[0]));
        } elseif (str_starts_with($types[0], self::ENUM)) {
            self::assertMatchesRegularExpression('~' . self::shortName($types[0]) . '::(tryFrom|from)\(~', $source, "{$operationId} reads a " . self::shortName($types[0]));
        }

        $item = self::itemSchema($response);

        if ($item !== null) {
            $itemType = self::phpTypes($item)[0];

            if (str_starts_with($itemType, self::DTO) || str_starts_with($itemType, self::ENUM)) {
                $short = self::shortName($itemType);
                self::assertMatchesRegularExpression("~@return (list<{$short}>|{$short}\\[\\])~", (string)$function->getDocComment(), "Documented items of {$operationId}");
                self::assertMatchesRegularExpression("~{$short}::(fromArray|tryFrom|from)\\(~", $source, "{$operationId} hydrates its items");
            }
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
            $class = self::ENUM . $short;
            self::assertTrue(enum_exists($class), "No enum {$class}");
            /** @var class-string<BackedEnum> $class */
            $cases = array_map(static fn (BackedEnum $case): string => (string)$case->value, $class::cases());
            $expected = array_merge(array_map('strval', $schema['enum']), self::EXTRA_ENUM_CASES[$name] ?? []);
            sort($cases);
            sort($expected);
            self::assertSame($expected, $cases, "Cases of {$class}");

            return;
        }

        $class = self::DTO . $short;
        self::assertTrue(class_exists($class), "No DTO {$class}");
        $properties = [];

        foreach (new ReflectionClass($class)->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            if (! $property->isStatic()) {
                $properties[$property->getName()] = $property;
            }
        }

        $expected = self::properties($schema);
        $names = array_keys($properties);
        $expectedNames = array_keys($expected);
        sort($names);
        sort($expectedNames);
        self::assertSame($expectedNames, $names, "Properties of {$class}");

        foreach ($expected as $propertyName => $propertySchema) {
            $property = $properties[$propertyName];
            self::assertContains(self::typeName($property->getType()), self::phpTypes($propertySchema), "Type of {$class}::\${$propertyName}");

            $item = self::itemSchema($propertySchema);

            if ($item === null || self::typeName($property->getType()) !== 'array') {
                continue;
            }

            $itemType = self::phpTypes($item)[0];
            $attributes = $property->getAttributes(ArrayItemType::class);
            $attribute = $attributes === [] ? null : $attributes[0]->newInstance();

            if (str_starts_with($itemType, self::DTO) || str_starts_with($itemType, self::ENUM)) {
                $kind = str_starts_with($itemType, self::DTO) ? 'dto' : 'enum';
                self::assertSame("{$kind} {$itemType}", $attribute === null ? 'none' : "{$attribute->type} {$attribute->class}", "Items of {$class}::\${$propertyName}");
            } elseif ($attribute !== null) {
                self::assertSame($itemType, $attribute->type, "Items of {$class}::\${$propertyName}");
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    private static function spec(): array
    {
        return self::$spec ??= Yaml::parseFile(self::SNAPSHOT);
    }

    /**
     * @return array<string, array{method: string, path: string, query: list<string>, body: array{contentType: string, schema: array<string, mixed>}|null, response: array<string, mixed>|null, rawResponse: bool, redirect: bool}>
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

                $operation = $item[$method];
                $query = [];

                foreach ([...$item['parameters'] ?? [], ...$operation['parameters'] ?? []] as $parameter) {
                    $parameter = self::resolve($parameter);

                    if ($parameter['in'] === 'query') {
                        $query[] = $parameter['name'];
                    }
                }

                $body = null;

                if (isset($operation['requestBody'])) {
                    $requestBody = self::resolve($operation['requestBody']);
                    $contentType = (string)array_key_first($requestBody['content']);
                    $body = ['contentType' => $contentType, 'schema' => $requestBody['content'][$contentType]['schema'] ?? []];
                }

                $success = [];
                $redirect = false;

                foreach ($operation['responses'] as $code => $response) {
                    if ((int)$code >= 200 && (int)$code < 300) {
                        $success = self::resolve($response);

                        break;
                    }

                    $redirect = $redirect || ((int)$code >= 300 && (int)$code < 400);
                }

                $operations[$operation['operationId']] = [
                    'method' => strtoupper($method),
                    'path' => $path,
                    'query' => array_values(array_unique($query)),
                    'body' => $body,
                    'response' => $success['content']['application/json']['schema'] ?? null,
                    'rawResponse' => ($success['content'] ?? []) !== [] && ! isset($success['content']['application/json']),
                    'redirect' => $success === [] && $redirect,
                ];
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

    private static function source(ReflectionMethod $function): string
    {
        $lines = file((string)$function->getFileName()) ?: [];

        return implode('', \array_slice($lines, (int)$function->getStartLine() - 1, (int)$function->getEndLine() - (int)$function->getStartLine() + 1));
    }

    /**
     * The request call of a method: HTTP method, path with its placeholders
     * named after the variables, and the query and body arguments.
     *
     * @return array{method: string, path: string, query: string|null, body: string|null, multipart: bool}
     */
    private static function requestCall(ReflectionMethod $function): array
    {
        $source = self::source($function);
        $found = preg_match('~->request\(\s*HttpMethod::(\w+),\s*(["\'])(.*?)\2(.*?)\);~s', $source, $match);
        self::assertSame(1, $found, "{$function->getName()} sends no request");

        $arguments = array_values(array_filter(array_map('trim', explode(',', $match[4])), static fn (string $argument): bool => $argument !== ''));
        $path = (string)preg_replace('~\{\$(\w+)(->value)?\}~', '{$1}', $match[3]);

        return [
            'method' => $match[1],
            'path' => $path,
            'query' => \in_array($arguments[0] ?? 'null', ['[]', 'null'], true) ? null : $arguments[0],
            'body' => \in_array($arguments[1] ?? 'null', ['null'], true) ? null : $arguments[1],
            'multipart' => ($arguments[2] ?? null) === "'multipart/form-data'",
        ];
    }

    /**
     * The keys of the query array a method sends.
     *
     * @return list<string>
     */
    private static function queryKeys(ReflectionMethod $function, ?string $variable): array
    {
        if ($variable === null) {
            return [];
        }

        $source = self::source($function);
        $name = preg_quote($variable, '~');
        $keys = [];

        if (preg_match("~{$name}\\s*=\\s*\\[(.*?)\\];~s", $source, $match) === 1) {
            preg_match_all('~[\'"]([^\'"]+)[\'"]\s*=>~', $match[1], $found);
            $keys = $found[1];
        }

        preg_match_all("~{$name}\\[[\\'\"]([^\\'\"]+)[\\'\"]\\]\\s*=~", $source, $assigned);

        return array_values(array_unique([...$keys, ...$assigned[1]]));
    }

    /**
     * The PHP types the client may use for a schema; the first one is the
     * preferred type.
     *
     * @param array<string, mixed> $schema
     * @return list<string>
     */
    private static function phpTypes(array $schema): array
    {
        if (isset($schema['$ref'])) {
            $name = basename($schema['$ref']);
            $target = self::resolve($schema);
            $short = self::CLASS_NAMES[$name] ?? $name;

            if (isset($target['enum'])) {
                return [self::ENUM . $short];
            }

            if (isset($target['properties']) || isset($target['allOf'])) {
                return [self::DTO . $short];
            }

            return self::phpTypes($target);
        }

        if (isset($schema['allOf']) && \count($schema['allOf']) === 1) {
            return self::phpTypes($schema['allOf'][0]);
        }

        $variants = $schema['oneOf'] ?? $schema['anyOf'] ?? null;

        if ($variants !== null) {
            $types = [];
            $objects = true;

            foreach ($variants as $variant) {
                if (($variant['$ref'] ?? null) === '#/components/schemas/Unset') {
                    // Optional update fields take the value or an UnsetType.
                    return ['mixed'];
                }

                $type = self::phpTypes($variant)[0];
                $types[$type] = true;
                $objects = $objects && (\in_array($type, ['array', 'mixed'], true) || str_starts_with($type, self::DTO));
            }

            return \count($types) === 1 ? [array_key_first($types)] : ($objects ? ['mixed', 'array'] : ['mixed']);
        }

        return match ($schema['type'] ?? null) {
            // The client reads dates into DateTimeImmutable; the specification spells the format in several ways.
            'string' => \in_array($schema['format'] ?? null, ['date', 'date-time', 'datetime'], true) ? ['string', DateTimeImmutable::class] : ['string'],
            'integer', 'int' => ['int'],
            'number' => ['float'],
            'boolean' => ['bool'],
            'array' => ['array'],
            'object' => ['array', 'mixed'],
            default => ['mixed'],
        };
    }

    /**
     * The item schema of an array schema, following references.
     *
     * @param array<string, mixed> $schema
     * @return array<string, mixed>|null
     */
    private static function itemSchema(array $schema): ?array
    {
        while (isset($schema['$ref']) && ! isset(self::resolve($schema)['properties'])) {
            $schema = self::resolve($schema);
        }

        return ($schema['type'] ?? null) === 'array' && \is_array($schema['items'] ?? null) && $schema['items'] !== [] ? $schema['items'] : null;
    }

    private static function typeName(?\ReflectionType $type): string
    {
        return $type instanceof ReflectionNamedType ? $type->getName() : (string)$type;
    }

    private static function shortName(string $class): string
    {
        return substr($class, (int)strrpos($class, '\\') + 1);
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
