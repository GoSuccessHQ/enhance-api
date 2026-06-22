<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the PlansListing schema.
 */
class PlansListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Plan> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Plan::class)]
    public ?array $items = null;

    public ?int $total = null;
}
