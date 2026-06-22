<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\NetworkStatus;
use GoSuccess\Enhance\Enum\RoleState;

/**
 * DTO for the RoleSummary schema.
 */
class RoleSummary extends AbstractDto
{
    public ?RoleState $state = null;

    public ?NetworkStatus $status = null;
}
