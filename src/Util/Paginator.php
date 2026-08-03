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
     * @param int $maxPages Upper bound on the pages to request (must be >= 1)
     * @throws \InvalidArgumentException On a non-positive page size or page limit
     * @throws \RuntimeException When the listing never ends within $maxPages
     * @return Generator<int, mixed>
     */
    public static function items(callable $fetchPage, int $pageSize = 100, int $maxPages = 1000): Generator
    {
        if ($pageSize < 1) {
            throw new \InvalidArgumentException('Page size must be at least 1');
        }

        if ($maxPages < 1) {
            throw new \InvalidArgumentException('Page limit must be at least 1');
        }

        $offset = 0;
        $pages = 0;

        do {
            // A listing that reports no total and ignores the offset would
            // otherwise keep handing out full pages forever.
            if (++$pages > $maxPages) {
                throw new \RuntimeException(\sprintf(
                    'Pagination stopped after %d pages without reaching the end of the listing; '
                    . 'raise $maxPages if the result set really is this large.',
                    $maxPages,
                ));
            }

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
