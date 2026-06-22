<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Exception;

/**
 * Thrown when the API rejects the request as invalid (HTTP 400).
 */
class BadRequestException extends ApiException
{
}
