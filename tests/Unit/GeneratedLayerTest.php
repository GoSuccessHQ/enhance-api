<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use BackedEnum;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Contract\HttpClientInterface;
use GoSuccess\Enhance\Enhance;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionProperty;

/**
 * Guards the generated layer against accidental breakage during manual edits.
 */
final class GeneratedLayerTest extends TestCase
{
    private const SRC = __DIR__ . '/../../src';

    public function testEntryPointWiresEveryResource(): void
    {
        $enhance = new Enhance(new Configuration('https://example.test/api', 'org', 'token'), $this->fakeClient());

        $wired = 0;
        foreach (new ReflectionClass(Enhance::class)->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $type = $property->getType();
            if (! $type instanceof ReflectionNamedType || ! str_ends_with($type->getName(), 'Resource')) {
                continue;
            }

            self::assertInstanceOf(AbstractResource::class, $enhance->{$property->getName()});
            $wired++;
        }

        self::assertGreaterThanOrEqual(33, $wired, 'Expected every API section to be wired as a resource');
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function resourceClasses(): iterable
    {
        yield from self::classesIn('Resource');
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function dtoClasses(): iterable
    {
        yield from self::classesIn('DTO');
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function enumClasses(): iterable
    {
        yield from self::classesIn('Enum');
    }

    #[DataProvider('resourceClasses')]
    public function testResourcesExtendAbstractResource(string $class): void
    {
        self::assertTrue(is_subclass_of($class, AbstractResource::class), "{$class} must extend AbstractResource");
    }

    #[DataProvider('dtoClasses')]
    public function testDtosHydrateAndSerialize(string $class): void
    {
        if (! is_subclass_of($class, AbstractDto::class)) {
            self::fail("{$class} must extend AbstractDto");
        }

        $instance = $class::fromArray([]);

        self::assertSame([], $instance->jsonSerialize(), "{$class} should serialize to an empty array when unset");
    }

    #[DataProvider('enumClasses')]
    public function testEnumsAreBacked(string $class): void
    {
        self::assertTrue(is_subclass_of($class, BackedEnum::class), "{$class} must be a backed enum");
    }

    /**
     * @return iterable<string, array{string}>
     */
    private static function classesIn(string $subNamespace): iterable
    {
        $files = glob(self::SRC . '/' . $subNamespace . '/*.php') ?: [];

        foreach ($files as $file) {
            $name = basename($file, '.php');

            yield $name => ['GoSuccess\\Enhance\\' . $subNamespace . '\\' . $name];
        }
    }

    private function fakeClient(): HttpClientInterface
    {
        return new class () implements HttpClientInterface {
            public function request(
                HttpMethod $method,
                string $endpoint,
                array $query = [],
                mixed $body = null,
                ?string $contentType = null,
            ): Response {
                return new Response(200, [], '{}');
            }
        };
    }
}
