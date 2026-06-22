<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ImportMigrationEntry schema.
 */
class ImportMigrationEntry extends AbstractDto
{
    public ?string $id = null;

    public ?string $orgId = null;

    public ?string $filename = null;

    public ?int $filesize = null;

    public ?string $status = null;

    public ?string $importType = null;

    public ?\DateTimeImmutable $createdAt = null;

    public ?\DateTimeImmutable $updatedAt = null;

    public ?int $percentageComplete = null;

    public ?string $primaryDomain = null;
}
