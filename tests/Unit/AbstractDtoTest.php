<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\HttpStatusCode;
use PHPUnit\Framework\TestCase;

final class AbstractDtoTest extends TestCase
{
    public function testHydratesScalarsWithCoercion(): void
    {
        $dto = AbstractDtoTestChild::fromArray(['name' => 'x', 'count' => '5', 'ratio' => '1.5', 'active' => 'true']);

        self::assertSame('x', $dto->name);
        self::assertSame(5, $dto->count);
        self::assertSame(1.5, $dto->ratio);
        self::assertTrue($dto->active);
    }

    public function testHydratesDateTimeEnumAndNestedDto(): void
    {
        $dto = AbstractDtoTestParent::fromArray([
            'createdAt' => '2026-06-22T10:00:00Z',
            'status' => 404,
            'child' => ['name' => 'inner', 'count' => 2],
        ]);

        self::assertInstanceOf(\DateTimeImmutable::class, $dto->createdAt);
        self::assertSame('2026-06-22', $dto->createdAt->format('Y-m-d'));
        self::assertSame(HttpStatusCode::NotFound, $dto->status);
        self::assertInstanceOf(AbstractDtoTestChild::class, $dto->child);
        self::assertSame('inner', $dto->child->name);
    }

    public function testHydratesArraysOfDtosAndEnums(): void
    {
        $dto = AbstractDtoTestParent::fromArray([
            'children' => [['name' => 'a'], ['name' => 'b']],
            'codes' => [200, 404],
        ]);

        self::assertCount(2, $dto->children);
        self::assertSame('b', $dto->children[1]->name);
        self::assertSame([HttpStatusCode::Ok, HttpStatusCode::NotFound], $dto->codes);
    }

    public function testIgnoresUnknownKeys(): void
    {
        $dto = AbstractDtoTestChild::fromArray(['name' => 'x', 'unknown' => 'ignored']);

        self::assertSame('x', $dto->name);
    }

    public function testJsonSerializeOmitsNullsAndEncodesValues(): void
    {
        $dto = new AbstractDtoTestParent();
        $dto->status = HttpStatusCode::Created;
        $dto->createdAt = new \DateTimeImmutable('2026-06-22T10:00:00+00:00');
        $dto->child = AbstractDtoTestChild::fromArray(['name' => 'inner']);

        $json = $dto->jsonSerialize();

        self::assertSame(201, $json['status']);
        self::assertSame('2026-06-22T10:00:00+00:00', $json['createdAt']);
        self::assertSame(['name' => 'inner'], $json['child']);
        self::assertArrayNotHasKey('children', $json);
        self::assertArrayNotHasKey('codes', $json);
    }
}

class AbstractDtoTestChild extends AbstractDto
{
    public ?string $name = null;

    public ?int $count = null;

    public ?float $ratio = null;

    public ?bool $active = null;
}

class AbstractDtoTestParent extends AbstractDto
{
    public ?\DateTimeImmutable $createdAt = null;

    public ?HttpStatusCode $status = null;

    public ?AbstractDtoTestChild $child = null;

    /** @var array<int, AbstractDtoTestChild> */
    #[ArrayItemType('dto', AbstractDtoTestChild::class)]
    public ?array $children = null;

    /** @var array<int, HttpStatusCode> */
    #[ArrayItemType('enum', HttpStatusCode::class)]
    public ?array $codes = null;
}
