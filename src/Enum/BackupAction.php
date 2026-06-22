<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The BackupAction enumeration.
 */
enum BackupAction: string
{
    case Backup = 'backup';

    case Restore = 'restore';
}
