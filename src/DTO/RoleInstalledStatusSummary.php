<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\RoleInstallationState;

/**
 * DTO for the RoleInstalledStatusSummary schema.
 */
class RoleInstalledStatusSummary extends AbstractDto
{
    public ?RoleInstallationState $application = null;

    public ?RoleInstallationState $backup = null;

    public ?RoleInstallationState $database = null;

    public ?RoleInstallationState $dns = null;

    public ?RoleInstallationState $email = null;

    public ?RoleInstallationState $postgresql = null;
}
