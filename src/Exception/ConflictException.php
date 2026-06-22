<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Exception;

/**
 * Thrown when the resource already exists or conflicts with the request (HTTP 409).
 */
class ConflictException extends ApiException
{
}
