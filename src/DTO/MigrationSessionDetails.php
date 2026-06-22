<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MigrationSessionDetails schema.
 */
class MigrationSessionDetails extends AbstractDto
{
    public ?string $id = null;

    public ?string $createdBy = null;

    public ?string $createdAt = null;

    public ?string $updatedAt = null;

    public ?int $migrationsCount = null;

    public ?float $percentageComplete = null;

    public ?int $notReadyCount = null;
}
