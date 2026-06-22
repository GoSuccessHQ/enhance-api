<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * What was the status code of an http request and its truncated body. Used with `failed4xx` and `failed5xx` statuses.
 */
class LogHttpMetadata extends AbstractDto
{
    public ?int $statusCode = null;

    public ?string $body = null;
}
