<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UnixTimestamp schema.
 */
class UnixTimestamp extends AbstractDto
{
    public ?int $seconds = null;
}
