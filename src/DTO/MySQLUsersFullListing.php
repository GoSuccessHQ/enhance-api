<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MySQLUsersFullListing schema.
 */
class MySQLUsersFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\MySQLUser> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\MySQLUser::class)]
    public ?array $items = null;
}
