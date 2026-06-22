<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the BackupsFullListing schema.
 */
class BackupsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Backup> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Backup::class)]
    public ?array $items = null;
}
