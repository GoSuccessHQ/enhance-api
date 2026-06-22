<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The MaintenanceMode enumeration.
 */
enum MaintenanceMode: string
{
    case Activate = 'activate';

    case Deactivate = 'deactivate';
}
