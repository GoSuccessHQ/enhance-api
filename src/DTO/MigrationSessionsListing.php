<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MigrationSessionsListing schema.
 */
class MigrationSessionsListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\MigrationSessionDetails> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\MigrationSessionDetails::class)]
    public ?array $items = null;

    public ?int $total = null;
}
