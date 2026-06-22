<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The MaintenanceModeStatus enumeration.
 */
enum MaintenanceModeStatus: string
{
    case Active = 'active';

    case Deactivated = 'deactivated';
}
