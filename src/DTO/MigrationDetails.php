<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\MigrationStatus;
use GoSuccess\Enhance\Enum\ServerRole;

/**
 * DTO for the MigrationDetails schema.
 */
class MigrationDetails extends AbstractDto
{
    public ?string $id = null;

    public ?string $websiteId = null;

    public ?string $sourceServerId = null;

    public ?string $destServerId = null;

    public ?string $destServerName = null;

    public ?ServerRole $serverRole = null;

    public ?MigrationStatus $migrationStatus = null;

    public ?string $createdAt = null;

    public ?string $lastUpdated = null;

    public ?string $websitePrimaryDomain = null;

    public ?int $percentageComplete = null;

    public ?string $sessionId = null;
}
