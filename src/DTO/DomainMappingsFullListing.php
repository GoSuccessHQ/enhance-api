<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DomainMappingsFullListing schema.
 */
class DomainMappingsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\DomainMapping> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\DomainMapping::class)]
    public ?array $items = null;
}
