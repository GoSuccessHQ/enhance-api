<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The WebsiteKind enumeration.
 */
enum WebsiteKind: string
{
    case Normal = 'normal';

    case ControlPanel = 'controlPanel';

    case PhpMyAdmin = 'phpMyAdmin';

    case Roundcube = 'roundcube';

    case Staging = 'staging';

    case ServerHostname = 'serverHostname';
}
