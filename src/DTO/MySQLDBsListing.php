<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MySQLDBsListing schema.
 */
class MySQLDBsListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\MySQLDB> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\MySQLDB::class)]
    public ?array $items = null;
}
