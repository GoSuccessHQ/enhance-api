<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The ResourceCheckManagerErrorKind enumeration.
 */
enum ResourceCheckManagerErrorKind: string
{
    case NonExistentResource = 'nonExistentResource';

    case ResourceOutOfQuota = 'resourceOutOfQuota';
}
