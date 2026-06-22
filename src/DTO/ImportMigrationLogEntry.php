<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\LogAction;
use GoSuccess\Enhance\Enum\LogKind;
use GoSuccess\Enhance\Enum\LogLevel;

/**
 * DTO for the ImportMigrationLogEntry schema.
 */
class ImportMigrationLogEntry extends AbstractDto
{
    public ?string $id = null;

    public ?string $createdAt = null;

    public ?string $migrationId = null;

    public ?string $logData = null;

    public ?int $percentageComplete = null;

    public ?LogLevel $level = null;

    public ?LogAction $action = null;

    public ?LogKind $kind = null;
}
