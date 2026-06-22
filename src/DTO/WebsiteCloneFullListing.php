<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsiteCloneFullListing schema.
 */
class WebsiteCloneFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\WebsiteCloneResponse> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\WebsiteCloneResponse::class)]
    public ?array $items = null;
}
