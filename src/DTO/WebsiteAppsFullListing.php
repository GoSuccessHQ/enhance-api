<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsiteAppsFullListing schema.
 */
class WebsiteAppsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\WebsiteApp> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\WebsiteApp::class)]
    public ?array $items = null;
}
