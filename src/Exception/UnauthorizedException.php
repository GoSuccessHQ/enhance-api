<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Exception;

/**
 * Thrown when the session is invalid or missing (HTTP 401).
 */
class UnauthorizedException extends ApiException
{
}
