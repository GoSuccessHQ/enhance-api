<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MembersListing schema.
 */
class MembersListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Member> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Member::class)]
    public ?array $items = null;

    public ?int $total = null;
}
