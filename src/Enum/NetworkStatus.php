<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The NetworkStatus enumeration.
 */
enum NetworkStatus: string
{
    case Unknown = 'unknown';

    case Online = 'online';

    case Restarting = 'restarting';

    case Warning = 'warning';

    case Critical = 'critical';
}
