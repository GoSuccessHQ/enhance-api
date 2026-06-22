<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Exception;

/**
 * Thrown when the session holder has insufficient privileges (HTTP 403).
 */
class ForbiddenException extends ApiException
{
}
