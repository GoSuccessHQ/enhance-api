<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the HttpdStatus schema.
 */
class HttpdStatus extends AbstractDto
{
    public ?string $rawOutput = null;
}
