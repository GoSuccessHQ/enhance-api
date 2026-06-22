<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UsedResourcesFullListing schema.
 */
class UsedResourcesFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\UsedResource> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\UsedResource::class)]
    public ?array $items = null;
}
