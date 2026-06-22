<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the JoomlaUsersFullListing schema.
 */
class JoomlaUsersFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\JoomlaUser> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\JoomlaUser::class)]
    public ?array $items = null;
}
