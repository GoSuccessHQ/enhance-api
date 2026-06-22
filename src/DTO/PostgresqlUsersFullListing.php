<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the PostgresqlUsersFullListing schema.
 */
class PostgresqlUsersFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\PostgresqlUser> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\PostgresqlUser::class)]
    public ?array $items = null;
}
