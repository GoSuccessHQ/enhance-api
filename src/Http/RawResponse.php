<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Http;

/**
 * What a {@see Transport} received: the status, the headers (names in lower
 * case) and the undecoded body. The client decodes and maps it.
 */
final readonly class RawResponse
{
    /**
     * @param array<string, string> $headers
     */
    public function __construct(
        public int $status,
        public array $headers,
        public string $body,
    ) {
    }
}
