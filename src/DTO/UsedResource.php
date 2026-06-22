<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ResourceName;

/**
 * DTO for the UsedResource schema.
 */
class UsedResource extends AbstractDto
{
    public ?ResourceName $name = null;

    /** The total quota of the resource. If not set, the resource has unlimited quota, but the resource usage is still tracked. */
    public ?int $total = null;

    public ?int $usage = null;
}
