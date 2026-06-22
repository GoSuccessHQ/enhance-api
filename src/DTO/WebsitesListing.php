<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsitesListing schema.
 */
class WebsitesListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Website> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Website::class)]
    public ?array $items = null;

    public ?int $total = null;
}
