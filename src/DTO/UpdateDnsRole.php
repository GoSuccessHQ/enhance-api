<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRoleState;

/**
 * DTO for the UpdateDnsRole schema.
 */
class UpdateDnsRole extends AbstractDto
{
    public ?ServerRoleState $state = null;
}
