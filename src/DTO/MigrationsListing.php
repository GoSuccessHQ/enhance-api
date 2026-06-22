<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MigrationsListing schema.
 */
class MigrationsListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\MigrationDetails> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\MigrationDetails::class)]
    public ?array $items = null;

    public ?int $total = null;
}
