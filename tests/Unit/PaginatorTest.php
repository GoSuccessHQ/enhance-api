<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\Util\Paginator;
use PHPUnit\Framework\TestCase;

final class PaginatorTest extends TestCase
{
    public function testIteratesAllPages(): void
    {
        $all = range(1, 25);
        $calls = [];

        $fetch = static function (int $offset, int $limit) use ($all, &$calls): object {
            $calls[] = [$offset, $limit];
            $page = new PaginatorTestListing();
            $page->items = array_slice($all, $offset, $limit);
            $page->total = count($all);

            return $page;
        };

        $items = iterator_to_array(Paginator::items($fetch, 10), false);

        self::assertSame($all, $items);
        self::assertSame([[0, 10], [10, 10], [20, 10]], $calls);
    }

    public function testStopsOnShortPageWithoutTotal(): void
    {
        $fetch = static function (int $offset, int $limit): object {
            $page = new PaginatorTestListing();
            $page->items = $offset === 0 ? range(1, 4) : [];
            $page->total = null;

            return $page;
        };

        $items = iterator_to_array(Paginator::items($fetch, 10), false);

        self::assertSame([1, 2, 3, 4], $items);
    }

    public function testRejectsInvalidPageSize(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        iterator_to_array(Paginator::items(static fn (): ?object => null, 0));
    }
}

class PaginatorTestListing
{
    /** @var array<int, mixed> */
    public array $items = [];

    public ?int $total = null;
}
