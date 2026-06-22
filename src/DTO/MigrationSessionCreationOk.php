<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MigrationSessionCreationOk schema.
 */
class MigrationSessionCreationOk extends AbstractDto
{
    public ?string $sessionId = null;

    public ?int $okCount = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\MigrationCreationOutcome> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\MigrationCreationOutcome::class)]
    public ?array $migrations = null;
}
