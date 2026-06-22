<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The ImportKind enumeration.
 */
enum ImportKind: string
{
    case CPanel = 'cPanel';

    case Plesk = 'plesk';

    case PleskStreaming = 'pleskStreaming';
}
