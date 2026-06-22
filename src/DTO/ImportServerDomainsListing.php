<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ImportServerDomainsListing schema.
 */
class ImportServerDomainsListing extends AbstractDto
{
    public ?int $total = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\ImportServerDomain> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ImportServerDomain::class)]
    public ?array $items = null;
}
