<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DomainsListing schema.
 */
class DomainsListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Domain> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Domain::class)]
    public ?array $items = null;

    public ?int $total = null;
}
