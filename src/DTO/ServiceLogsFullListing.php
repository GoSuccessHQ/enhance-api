<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServiceLogsFullListing schema.
 */
class ServiceLogsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\ServiceLog> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServiceLog::class)]
    public ?array $items = null;
}
