<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\BackupAction;
use GoSuccess\Enhance\Enum\OperationStatus;

/**
 * DTO for the BackupStatus schema.
 */
class BackupStatus extends AbstractDto
{
    public ?int $id = null;

    public ?string $websiteId = null;

    public ?\DateTimeImmutable $startedAt = null;

    public ?BackupAction $action = null;

    public ?OperationStatus $homeDirStatus = null;

    public ?OperationStatus $mysqlDbsStatus = null;

    public ?OperationStatus $emailsStatus = null;
}
