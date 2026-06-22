<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ImportServerSettingsFullListing schema.
 */
class ImportServerSettingsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\ImportServerSettings> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ImportServerSettings::class)]
    public ?array $items = null;
}
