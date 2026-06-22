<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WpUsersFullListing schema.
 */
class WpUsersFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\WpUser> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\WpUser::class)]
    public ?array $items = null;
}
