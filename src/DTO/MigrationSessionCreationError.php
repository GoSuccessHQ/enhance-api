<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MigrationSessionCreationError schema.
 */
class MigrationSessionCreationError extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\MigrationCreationOutcome> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\MigrationCreationOutcome::class)]
    public ?array $migrations = null;
}
