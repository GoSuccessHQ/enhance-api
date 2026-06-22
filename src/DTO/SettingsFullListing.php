<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SettingsFullListing schema.
 */
class SettingsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Setting> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Setting::class)]
    public ?array $items = null;
}
