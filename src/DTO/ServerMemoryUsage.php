<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerMemoryUsage schema.
 */
class ServerMemoryUsage extends AbstractDto
{
    public ?SpaceUsage $ram = null;

    public ?SpaceUsage $swap = null;
}
