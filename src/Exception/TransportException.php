<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Exception;

/**
 * A request did not reach the API or got no answer: connection error,
 * timeout or a refused response. Thrown by a {@see \GoSuccess\Enhance\Http\Transport};
 * the client retries it like any transport failure.
 */
class TransportException extends RequestException
{
}
