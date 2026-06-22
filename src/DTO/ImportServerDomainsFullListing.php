<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ImportServerDomainsFullListing schema.
 */
class ImportServerDomainsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\ImportServerDomain> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ImportServerDomain::class)]
    public ?array $items = null;
}
