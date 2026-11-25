<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Http;

use GoSuccess\Enhance\Enum\HttpStatusCode;

/**
 * Immutable representation of an HTTP response from the Enhance API.
 */
final class Response
{
    /**
     * HTTP status code as a typed enum, or null for an unmapped code.
     */
    public ?HttpStatusCode $status {
        get => HttpStatusCode::tryFrom($this->statusCode);
    }

    /**
     * Whether the response has a 2xx status code.
     */
    public bool $isSuccess {
        get => $this->statusCode >= 200 && $this->statusCode < 300;
    }

    /**
     * Whether the response has a 3xx status code.
     */
    public bool $isRedirect {
        get => $this->statusCode >= 300 && $this->statusCode < 400;
    }

    /**
     * Target of a redirect, taken from the Location header.
     *
     * Redirects are never followed, so SSO endpoints can hand back the URL
     * they point at instead of the client fetching it.
     */
    public ?string $location {
        get => $this->header('location');
    }

    /**
     * The body as text, for endpoints that return a log or a file.
     *
     * A body that is a JSON string is decoded; any other body is returned
     * verbatim, so plain text keeps its quotes and whitespace. Null when the
     * body is empty.
     */
    public ?string $text {
        get {
            if ($this->rawBody === '') {
                return null;
            }

            try {
                $value = json_decode($this->rawBody, false, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException) {
                return $this->rawBody;
            }

            return \is_string($value) ? $value : $this->rawBody;
        }
    }

    /**
     * @param int $statusCode HTTP status code
     * @param mixed $decoded JSON-decoded response body (array, scalar, or null)
     * @param string $rawBody Raw response body
     * @param array<string, string> $headers Response headers keyed by lowercase name
     */
    public function __construct(
        public readonly int $statusCode,
        public readonly mixed $decoded,
        public readonly string $rawBody,
        public readonly array $headers = [],
    ) {
    }

    public function header(string $name): ?string
    {
        return $this->headers[strtolower($name)] ?? null;
    }
}
