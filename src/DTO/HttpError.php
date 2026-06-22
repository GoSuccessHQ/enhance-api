<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the HttpError schema.
 */
class HttpError extends AbstractDto
{
    public ?string $code = null;

    public ?string $detail = null;

    public ?string $message = null;
}
