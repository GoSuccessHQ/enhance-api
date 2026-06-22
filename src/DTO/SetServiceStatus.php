<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServiceStatusAction;

/**
 * DTO for the SetServiceStatus schema.
 */
class SetServiceStatus extends AbstractDto
{
    public ?ServiceStatusAction $action = null;
}
