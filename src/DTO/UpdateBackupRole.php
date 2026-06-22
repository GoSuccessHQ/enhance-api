<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRoleState;

/**
 * DTO for the UpdateBackupRole schema.
 */
class UpdateBackupRole extends AbstractDto
{
    public ?ServerRoleState $state = null;
}
