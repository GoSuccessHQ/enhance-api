<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Client;

use GoSuccess\Enhance\Contract\HttpClientInterface;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Exception\ApiException;
use GoSuccess\Enhance\Exception\BadRequestException;
use GoSuccess\Enhance\Exception\ConflictException;
use GoSuccess\Enhance\Exception\ForbiddenException;
use GoSuccess\Enhance\Exception\NotFoundException;
use GoSuccess\Enhance\Exception\RateLimitException;
use GoSuccess\Enhance\Exception\RequestException;
use GoSuccess\Enhance\Exception\ServerException;
use GoSuccess\Enhance\Exception\UnauthorizedException;
use GoSuccess\Enhance\Http\Response;

/**
 * cURL-based HTTP client for the Enhance API.
 *
 * Handles authentication, JSON (and multipart/binary) payloads, idempotency-aware
 * retries with exponential backoff for transient failures, and maps error
 * responses onto the typed exception hierarchy. Depends only on the cURL extension.
 */
final class ApiClient implements HttpClientInterface
{
    /**
     * Reused cURL handle, enabling connection keep-alive across requests.
     *
     * Since PHP 8.0 this is a \CurlHandle object that is closed automatically
     * once it goes out of scope, so no explicit teardown is required.
     */
    private ?\CurlHandle $handle = null;

    public function __construct(
        private readonly Configuration $config,
    ) {
        if (! \extension_loaded('curl')) {
            throw new RequestException('The cURL extension is required but not loaded');
        }
    }

    public function request(
        HttpMethod $method,
        string $endpoint,
        array $query = [],
        mixed $body = null,
        ?string $contentType = null,
    ): Response {
        $url = $this->config->host . $endpoint;
        $queryString = $this->buildQuery($query);

        if ($queryString !== '') {
            $url .= (str_contains($url, '?') ? '&' : '?') . $queryString;
        }

        $attempt = 0;

        while (true) {
            $attempt++;

            [$response, $curlError] = $this->execute($method, $url, $body, $contentType);

            if ($curlError === null && $response instanceof Response && ! $this->isRetryable($response->statusCode)) {
                return $this->handle($response);
            }

            if ($attempt <= $this->config->maxRetries && $this->shouldRetry($method, $response, $curlError)) {
                $this->wait($attempt, $response);

                continue;
            }

            if ($curlError !== null) {
                throw new RequestException(
                    \sprintf('HTTP request to %s failed: %s', $url, $curlError),
                    0,
                    ['url' => $url, 'method' => $method->value],
                );
            }

            /** @var Response $response */
            return $this->handle($response);
        }
    }

    /**
     * Execute a single request attempt.
     *
     * @return array{0: Response|null, 1: string|null} Tuple of response and cURL error message
     */
    private function execute(HttpMethod $method, string $url, mixed $body, ?string $contentType): array
    {
        if ($url === '') {
            throw new RequestException('Request URL must not be empty');
        }

        $headers = [
            'Accept: application/json',
            'Authorization: Bearer ' . $this->config->accessToken,
            'User-Agent: ' . $this->config->userAgent,
        ];

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_ENCODING => '',
            CURLOPT_CONNECTTIMEOUT => $this->config->connectTimeout,
            CURLOPT_TIMEOUT => $this->config->timeout,
            CURLOPT_SSL_VERIFYPEER => $this->config->verifySsl,
            CURLOPT_SSL_VERIFYHOST => $this->config->verifySsl ? 2 : 0,
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method->value,
            CURLOPT_HEADER => true,
        ];

        $payload = $this->encodeBody($body, $contentType, $headers);

        if ($payload !== null) {
            $options[CURLOPT_POSTFIELDS] = $payload;
        }

        $options[CURLOPT_HTTPHEADER] = $headers;

        // Reuse the handle across requests so cURL can keep the connection alive.
        $ch = $this->handle ??= curl_init();
        curl_reset($ch);
        curl_setopt_array($ch, $options);

        $raw = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $statusCode = (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $headerSize = (int)curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        if ($errno !== 0 || ! \is_string($raw)) {
            return [null, $error !== '' ? $error : 'unknown cURL error'];
        }

        $rawHeaders = substr($raw, 0, $headerSize);
        $rawBody = substr($raw, $headerSize);

        return [
            new Response($statusCode, $this->decode($rawBody), $rawBody, $this->parseHeaders($rawHeaders)),
            null,
        ];
    }

    /**
     * Encode the request body and append the matching Content-Type header.
     *
     * @param list<string> $headers
     * @return string|array<string, mixed>|null
     */
    private function encodeBody(mixed $body, ?string $contentType, array &$headers): string|array|null
    {
        if ($body === null) {
            return null;
        }

        if ($contentType === 'multipart/form-data') {
            // Let cURL build the multipart body and boundary from the array.
            return \is_array($body) ? $body : [];
        }

        if ($contentType !== null && $contentType !== 'application/json') {
            $headers[] = 'Content-Type: ' . $contentType;

            return \is_string($body) ? $body : (string)$body;
        }

        $headers[] = 'Content-Type: application/json';

        return json_encode($body, JSON_THROW_ON_ERROR);
    }

    private function decode(string $rawBody): mixed
    {
        if (trim($rawBody) === '') {
            return null;
        }

        try {
            return json_decode($rawBody, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            // Some endpoints return a bare, unquoted string (e.g. a version number).
            return trim($rawBody, "\" \n\r\t");
        }
    }

    /**
     * @return array<string, string>
     */
    private function parseHeaders(string $rawHeaders): array
    {
        $headers = [];

        foreach (explode("\r\n", $rawHeaders) as $line) {
            $position = strpos($line, ':');

            if ($position === false) {
                continue;
            }

            $name = strtolower(trim(substr($line, 0, $position)));
            $headers[$name] = trim(substr($line, $position + 1));
        }

        return $headers;
    }

    /**
     * Build a query string, expanding array values into repeated keys
     * (OpenAPI "form"/explode style) and normalizing enums and booleans.
     *
     * @param array<string, scalar|\BackedEnum|array<int, scalar|\BackedEnum>|null> $query
     */
    private function buildQuery(array $query): string
    {
        $pairs = [];

        foreach ($query as $key => $value) {
            if ($value === null) {
                continue;
            }

            foreach (\is_array($value) ? $value : [$value] as $item) {
                if ($item instanceof \BackedEnum) {
                    $item = $item->value;
                }

                if (\is_bool($item)) {
                    $item = $item ? 'true' : 'false';
                }

                $pairs[] = rawurlencode($key) . '=' . rawurlencode((string)$item);
            }
        }

        return implode('&', $pairs);
    }

    private function handle(Response $response): Response
    {
        if ($response->isSuccess) {
            return $response;
        }

        $context = ['status' => $response->statusCode, 'body' => $response->decoded];
        $message = $this->messageFor($response);

        throw match ($response->statusCode) {
            400 => new BadRequestException($message, 400, $context),
            401 => new UnauthorizedException($message, 401, $context),
            403 => new ForbiddenException($message, 403, $context),
            404 => new NotFoundException($message, 404, $context),
            409 => new ConflictException($message, 409, $context),
            429 => new RateLimitException($message, 429, $context),
            default => $response->statusCode >= 500
                ? new ServerException($message, $response->statusCode, $context)
                : new ApiException($message, $response->statusCode, $context),
        };
    }

    private function messageFor(Response $response): string
    {
        $decoded = $response->decoded;

        if (\is_array($decoded)) {
            foreach (['message', 'error', 'detail'] as $key) {
                if (isset($decoded[$key]) && \is_string($decoded[$key])) {
                    return $decoded[$key];
                }
            }
        }

        if (\is_string($decoded) && $decoded !== '') {
            return $decoded;
        }

        return \sprintf('Enhance API returned HTTP %d', $response->statusCode);
    }

    private function isRetryable(int $statusCode): bool
    {
        return $statusCode === 429 || $statusCode >= 500;
    }

    /**
     * Decide whether a failed attempt may be safely retried.
     *
     * A 429 is always safe (the request was rejected, not processed). Transport
     * errors and 5xx responses are only retried for idempotent methods, so that
     * a POST/PATCH that may already have been applied is never repeated.
     */
    private function shouldRetry(HttpMethod $method, ?Response $response, ?string $curlError): bool
    {
        if ($curlError !== null) {
            return $this->isIdempotent($method);
        }

        if (! $response instanceof Response) {
            return false;
        }

        if ($response->statusCode === 429) {
            return true;
        }

        return $response->statusCode >= 500 && $this->isIdempotent($method);
    }

    private function isIdempotent(HttpMethod $method): bool
    {
        return match ($method) {
            HttpMethod::GET, HttpMethod::PUT, HttpMethod::DELETE => true,
            HttpMethod::POST, HttpMethod::PATCH => false,
        };
    }

    /**
     * Wait before the next retry. Honors a Retry-After header (seconds or an
     * HTTP date) on 429 responses, otherwise uses exponential backoff.
     */
    private function wait(int $attempt, ?Response $response): void
    {
        $retryAfter = $response?->header('retry-after');

        if ($retryAfter !== null) {
            $seconds = is_numeric($retryAfter)
                ? (int)$retryAfter
                : max(0, ((int)strtotime($retryAfter)) - time());

            if ($seconds > 0) {
                sleep(min($seconds, 60));

                return;
            }
        }

        // Exponential backoff: 100ms, 200ms, 400ms, ...
        usleep((int)(100_000 * 2 ** ($attempt - 1)));
    }
}
