<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The ServiceStatusAction enumeration.
 */
enum ServiceStatusAction: string
{
    case GracefulRestart = 'gracefulRestart';

    case ForceRestart = 'forceRestart';
}
