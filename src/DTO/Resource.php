<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ResourceName;

/**
 * Defines a resource that the MO or resellers can sell.
 */
class Resource extends AbstractDto
{
    public ?ResourceName $name = null;

    /** The total quota of the resource. If not set, the resource has unlimited quota. A reseller may only sell unlimited quota if the subscription to which itself is subscribed has the same resource with unlimited quota. */
    public ?int $total = null;
}
