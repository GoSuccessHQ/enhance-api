<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WpPluginsFullListing schema.
 */
class WpPluginsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\WpPlugin> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\WpPlugin::class)]
    public ?array $items = null;
}
