<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsiteLogsFullListing schema.
 */
class WebsiteLogsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\WebsiteLog> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\WebsiteLog::class)]
    public ?array $items = null;
}
