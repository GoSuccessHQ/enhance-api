<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRoleState;

/**
 * DTO for the UpdateApplicationRole schema.
 */
class UpdateApplicationRole extends AbstractDto
{
    public ?ServerRoleState $state = null;
}
