<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Exception;

/**
 * Thrown when a request fails at the transport level (e.g. a cURL error)
 * before any HTTP response is received.
 */
class RequestException extends ApiException
{
}
