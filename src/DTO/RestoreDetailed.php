<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\OperationStatus;

/**
 * DTO for the RestoreDetailed schema.
 */
class RestoreDetailed extends AbstractDto
{
    public ?int $backupId = null;

    public ?\DateTimeImmutable $startedAt = null;

    public ?\DateTimeImmutable $finishedAt = null;

    public ?OperationStatus $homeDirStatus = null;

    public ?OperationStatus $mysqlDbsStatus = null;

    public ?OperationStatus $emailsStatus = null;
}
