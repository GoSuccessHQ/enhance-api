<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The BackupKind enumeration.
 */
enum BackupKind: string
{
    case Manual = 'manual';

    case Automatic = 'automatic';

    case Archive = 'archive';
}
