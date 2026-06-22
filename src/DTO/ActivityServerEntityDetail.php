<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ActivityServerEntityDetail schema.
 */
class ActivityServerEntityDetail extends AbstractDto
{
    public ?string $friendlyName = null;

    public ?string $hostname = null;
}
