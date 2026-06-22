<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerStatsFullListing schema.
 */
class ServerStatsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\ServerStatEntry> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerStatEntry::class)]
    public ?array $items = null;
}
