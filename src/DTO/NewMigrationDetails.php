<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRole;

/**
 * DTO for the NewMigrationDetails schema.
 */
class NewMigrationDetails extends AbstractDto
{
    public ?string $websiteId = null;

    public ?string $destServerId = null;

    public ?ServerRole $serverRole = null;
}
