<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRoleState;

/**
 * DTO for the BackupRoleInfo schema.
 */
class BackupRoleInfo extends AbstractDto
{
    public ?ServerRoleState $state = null;

    public ?int $usage = null;

    public ?int $snapshotsCount = null;

    public ?int $last24hSnapshotsCount = null;

    public ?ServiceInfo $bkupd = null;

    /** The number of websites whose backups are assigned to be on this backup role. */
    public ?int $websitesCount = null;
}
