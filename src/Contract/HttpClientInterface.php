<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Contract;

use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Exception\ApiException;
use GoSuccess\Enhance\Http\Response;

/**
 * Contract for HTTP clients that communicate with the Enhance API.
 *
 * Abstracting the transport keeps the resources decoupled from cURL and
 * makes the client trivial to fake in tests.
 */
interface HttpClientInterface
{
    /**
     * Send a request to the API and return the decoded response.
     *
     * @param HttpMethod $method HTTP method
     * @param string $endpoint Endpoint path beginning with a slash (e.g. '/orgs/{id}/websites')
     * @param array<string, scalar|\BackedEnum|null> $query Query string parameters (null values are skipped)
     * @param mixed $body Request body: a DTO, array, or scalar for JSON; raw payload for other content types
     * @param string|null $contentType Override request content type (e.g. 'multipart/form-data', 'application/gzip')
     * @throws ApiException When the request fails or the API returns an error status
     */
    public function request(
        HttpMethod $method,
        string $endpoint,
        array $query = [],
        mixed $body = null,
        ?string $contentType = null,
    ): Response;
}
