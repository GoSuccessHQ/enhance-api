<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Base;

use BackedEnum;
use DateTimeImmutable;
use DateTimeInterface;
use GoSuccess\Enhance\Attribute\ArrayItemType;
use JsonSerializable;
use ReflectionNamedType;
use ReflectionProperty;

/**
 * Base class for all data transfer objects.
 *
 * Provides reflection-based hydration from API responses ({@see fromArray})
 * and JSON serialization for request bodies ({@see jsonSerialize}). Property
 * metadata is reflected once per class and cached.
 */
abstract class AbstractDto implements JsonSerializable
{
    /**
     * Cached property metadata keyed by class name.
     *
     * @var array<class-string, array<string, array{kind: string, class: class-string|null, itemKind: string|null, itemClass: class-string|null}>>
     */
    private static array $metaCache = [];

    /**
     * Create an instance from an API response payload.
     *
     * @param array<string, mixed>|object $data
     */
    public static function fromArray(array|object $data): static
    {
        $data = (array) $data;
        $dto = new static();

        foreach (static::meta() as $name => $meta) {
            if (! \array_key_exists($name, $data)) {
                continue;
            }

            $dto->{$name} = self::cast($data[$name], $meta);
        }

        return $dto;
    }

    /**
     * Serialize the DTO for a JSON request body, omitting null/unset properties.
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $out = [];

        foreach (array_keys(static::meta()) as $name) {
            if (! isset($this->{$name})) {
                continue;
            }

            $out[$name] = self::encode($this->{$name});
        }

        return $out;
    }

    /**
     * @param array{kind: string, class: class-string|null, itemKind: string|null, itemClass: class-string|null} $meta
     */
    private static function cast(mixed $value, array $meta): mixed
    {
        if ($value === null) {
            return null;
        }

        return match ($meta['kind']) {
            'int' => \is_numeric($value) ? (int) $value : null,
            'float' => \is_numeric($value) ? (float) $value : null,
            'string' => \is_scalar($value) ? (string) $value : null,
            'bool' => self::toBool($value),
            'datetime' => self::toDateTime($value),
            'enum' => self::toEnum($meta['class'], $value),
            'dto' => self::toDto($meta['class'], $value),
            'array' => self::toArray($value, $meta),
            default => $value,
        };
    }

    /**
     * @param array{itemKind: string|null, itemClass: class-string|null} $meta
     * @return array<int|string, mixed>
     */
    private static function toArray(mixed $value, array $meta): array
    {
        if (! \is_array($value)) {
            return [];
        }

        return match ($meta['itemKind']) {
            'dto' => array_map(static fn (mixed $item): mixed => self::toDto($meta['itemClass'], $item), $value),
            'enum' => array_map(static fn (mixed $item): mixed => self::toEnum($meta['itemClass'], $item), $value),
            'int' => array_map(static fn (mixed $item): ?int => \is_numeric($item) ? (int) $item : null, $value),
            'float' => array_map(static fn (mixed $item): ?float => \is_numeric($item) ? (float) $item : null, $value),
            'string' => array_map(static fn (mixed $item): ?string => \is_scalar($item) ? (string) $item : null, $value),
            default => $value,
        };
    }

    /**
     * @param class-string|null $class
     */
    private static function toEnum(?string $class, mixed $value): ?BackedEnum
    {
        if ($class === null || ! is_subclass_of($class, BackedEnum::class) || ! (\is_string($value) || \is_int($value))) {
            return null;
        }

        return $class::tryFrom($value);
    }

    /**
     * @param class-string|null $class
     */
    private static function toDto(?string $class, mixed $value): ?self
    {
        if ($class === null || ! is_subclass_of($class, self::class) || ! (\is_array($value) || \is_object($value))) {
            return null;
        }

        return $class::fromArray($value);
    }

    private static function toDateTime(mixed $value): ?DateTimeImmutable
    {
        if (! \is_string($value) || trim($value) === '') {
            return null;
        }

        try {
            return new DateTimeImmutable($value);
        } catch (\Exception) {
            return null;
        }
    }

    private static function toBool(mixed $value): ?bool
    {
        if (\is_bool($value)) {
            return $value;
        }

        return match (\is_string($value) ? strtolower(trim($value)) : $value) {
            true, 1, '1', 'true' => true,
            false, 0, '0', 'false' => false,
            default => null,
        };
    }

    private static function encode(mixed $value): mixed
    {
        if ($value instanceof DateTimeInterface) {
            return $value->format(DATE_ATOM);
        }

        if ($value instanceof BackedEnum) {
            return $value->value;
        }

        if ($value instanceof self) {
            return $value->jsonSerialize();
        }

        if (\is_array($value)) {
            return array_map(self::encode(...), $value);
        }

        return $value;
    }

    /**
     * Reflect and cache property metadata for the current class.
     *
     * @return array<string, array{kind: string, class: class-string|null, itemKind: string|null, itemClass: class-string|null}>
     */
    private static function meta(): array
    {
        if (isset(self::$metaCache[static::class])) {
            return self::$metaCache[static::class];
        }

        $meta = [];

        foreach ((new \ReflectionClass(static::class))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            if ($property->isStatic()) {
                continue;
            }

            $type = $property->getType();
            $typeName = $type instanceof ReflectionNamedType ? $type->getName() : 'mixed';

            $entry = ['kind' => 'mixed', 'class' => null, 'itemKind' => null, 'itemClass' => null];

            if ($typeName === 'array') {
                $entry['kind'] = 'array';
                [$entry['itemKind'], $entry['itemClass']] = self::arrayItem($property);
            } elseif (\in_array($typeName, ['int', 'float', 'string', 'bool'], true)) {
                $entry['kind'] = $typeName;
            } elseif ($typeName === DateTimeImmutable::class) {
                $entry['kind'] = 'datetime';
            } elseif (is_subclass_of($typeName, BackedEnum::class)) {
                $entry['kind'] = 'enum';
                $entry['class'] = $typeName;
            } elseif (is_subclass_of($typeName, self::class)) {
                $entry['kind'] = 'dto';
                $entry['class'] = $typeName;
            }

            $meta[$property->getName()] = $entry;
        }

        return self::$metaCache[static::class] = $meta;
    }

    /**
     * @return array{0: string|null, 1: class-string|null}
     */
    private static function arrayItem(ReflectionProperty $property): array
    {
        $attributes = $property->getAttributes(ArrayItemType::class);

        if ($attributes === []) {
            return [null, null];
        }

        $instance = $attributes[0]->newInstance();

        return [$instance->type, $instance->class];
    }
}
