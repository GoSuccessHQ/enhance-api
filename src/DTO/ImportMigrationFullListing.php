<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ImportMigrationFullListing schema.
 */
class ImportMigrationFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\ImportMigrationEntry> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ImportMigrationEntry::class)]
    public ?array $items = null;
}
