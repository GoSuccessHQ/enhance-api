<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsiteResourceUsageFullListing schema.
 */
class WebsiteResourceUsageFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\ResourceSample> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ResourceSample::class)]
    public ?array $items = null;
}
