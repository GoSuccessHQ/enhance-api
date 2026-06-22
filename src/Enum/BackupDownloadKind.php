<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The BackupDownloadKind enumeration.
 */
enum BackupDownloadKind: string
{
    case Website = 'website';

    case Email = 'email';
}
