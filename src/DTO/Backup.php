<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\BackupKind;
use GoSuccess\Enhance\Enum\BackupStorageKind;
use GoSuccess\Enhance\Enum\OperationStatus;

/**
 * DTO for the Backup schema.
 */
class Backup extends AbstractDto
{
    public ?int $id = null;

    public ?\DateTimeImmutable $startedAt = null;

    public ?\DateTimeImmutable $finishedAt = null;

    public ?string $snapshotDirName = null;

    public ?int $size = null;

    public ?OperationStatus $homeDirStatus = null;

    public ?int $filesSize = null;

    public ?OperationStatus $mysqlDbsStatus = null;

    public ?int $mysqlDbsCount = null;

    public ?int $postgresqlDbsCount = null;

    public ?int $mysqlDbsSize = null;

    public ?OperationStatus $emailsStatus = null;

    public ?int $emailsCount = null;

    public ?int $emailsSize = null;

    public ?BackupKind $kind = null;

    public ?string $description = null;

    public ?BackupStorageKind $storageKind = null;
}
