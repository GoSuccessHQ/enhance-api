<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerStatusAction;

/**
 * DTO for the SetServerStatus schema.
 */
class SetServerStatus extends AbstractDto
{
    public ?ServerStatusAction $action = null;
}
