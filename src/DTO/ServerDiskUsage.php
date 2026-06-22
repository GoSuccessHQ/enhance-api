<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerDiskUsage schema.
 */
class ServerDiskUsage extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Disk> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Disk::class)]
    public ?array $disks = null;
}
