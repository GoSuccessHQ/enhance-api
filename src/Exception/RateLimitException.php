<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Exception;

/**
 * Thrown when the API rate limit has been exceeded (HTTP 429).
 */
class RateLimitException extends ApiException
{
}
