<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Http;

use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Exception\TransportException;

/**
 * Sends one HTTP request for the client. The default is {@see CurlTransport};
 * an application can pass its own, for example to route the requests
 * through its HTTP stack, fake them in tests or limit the response size.
 *
 * Implementations MUST:
 * - throw a {@see TransportException} for transport-level failures
 *   (connection errors, timeouts), but never for HTTP error status codes,
 *   which are returned as a normal {@see RawResponse};
 * - not follow redirects;
 * - honor the timeouts and the TLS verification of the configuration.
 */
interface Transport
{
    /**
     * @param list<string> $headers complete header lines, e.g. "Accept: application/json"
     * @param string|array<string, mixed>|null $payload the encoded body; an array is a multipart form
     *
     * @throws TransportException
     */
    public function send(HttpMethod $method, string $url, array $headers, string|array|null $payload, Configuration $config): RawResponse;
}
