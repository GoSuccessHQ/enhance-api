<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the CustomersListing schema.
 */
class CustomersListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Org> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Org::class)]
    public ?array $items = null;

    public ?int $total = null;
}
