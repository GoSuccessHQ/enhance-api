<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Exception;

use Throwable;

/**
 * Base exception for all Enhance API errors.
 */
class ApiException extends \Exception
{
    /**
     * @param string $message Error message
     * @param int $code HTTP status code or internal error code
     * @param array<string, mixed> $context Additional error context (e.g. response body)
     * @param Throwable|null $previous Previous exception for chaining
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        protected array $context = [],
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the full error context.
     *
     * @return array<string, mixed>
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * Get a specific context value.
     */
    public function getContextValue(string $key, mixed $default = null): mixed
    {
        return $this->context[$key] ?? $default;
    }
}
