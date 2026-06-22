<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the RolesSummary schema.
 */
class RolesSummary extends AbstractDto
{
    public ?RoleSummary $email = null;

    public ?RoleSummary $backup = null;

    public ?RoleSummary $database = null;

    public ?RoleSummary $application = null;

    public ?RoleSummary $dns = null;

    public ?RoleSummary $controlPanel = null;

    public ?RoleSummary $postgresql = null;
}
