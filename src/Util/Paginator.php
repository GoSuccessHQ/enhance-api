<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Util;

use Generator;

/**
 * Transparently iterates over all items of a paginated listing endpoint.
 *
 * The listing endpoints accept `offset`/`limit` parameters and return a DTO
 * with a public `items` array (and usually an `int $total`). This helper keeps
 * fetching pages until the listing is exhausted.
 */
final class Paginator
{
    /**
     * Yield every item across all pages.
     *
     * @param callable(int $offset, int $limit): ?object $fetchPage Returns a listing DTO for the given window
     * @param int $pageSize Number of items to request per page (must be >= 1)
     * @return Generator<int, mixed>
     */
    public static function items(callable $fetchPage, int $pageSize = 100): Generator
    {
        if ($pageSize < 1) {
            throw new \InvalidArgumentException('Page size must be at least 1');
        }

        $offset = 0;

        do {
            $page = $fetchPage($offset, $pageSize);
            $vars = \is_object($page) ? get_object_vars($page) : [];

            $items = isset($vars['items']) && \is_array($vars['items']) ? $vars['items'] : [];
            $total = isset($vars['total']) && \is_int($vars['total']) ? $vars['total'] : null;

            foreach ($items as $item) {
                yield $item;
            }

            $count = \count($items);
            $offset += $count;
        } while ($count === $pageSize && ($total === null || $offset < $total));
    }
}
