<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the InstallableWebsiteAppsFullListing schema.
 */
class InstallableWebsiteAppsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\InstallableWebsiteApp> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\InstallableWebsiteApp::class)]
    public ?array $items = null;
}
