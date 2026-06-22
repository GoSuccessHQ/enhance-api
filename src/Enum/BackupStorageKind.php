<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The BackupStorageKind enumeration.
 */
enum BackupStorageKind: string
{
    case Enhance = 'enhance';

    case S3 = 's3';
}
