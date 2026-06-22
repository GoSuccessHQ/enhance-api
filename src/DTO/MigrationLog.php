<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MigrationLog schema.
 */
class MigrationLog extends AbstractDto
{
    public ?int $id = null;

    public ?string $createdAt = null;

    public ?string $migrationId = null;

    public ?string $logData = null;
}
