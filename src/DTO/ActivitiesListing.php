<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ActivitiesListing schema.
 */
class ActivitiesListing extends AbstractDto
{
    public ?int $total = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Activity> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Activity::class)]
    public ?array $items = null;
}
