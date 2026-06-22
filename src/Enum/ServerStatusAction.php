<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The ServerStatusAction enumeration.
 */
enum ServerStatusAction: string
{
    case GracefulReboot = 'gracefulReboot';

    case ForceReboot = 'forceReboot';
}
