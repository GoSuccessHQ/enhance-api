<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The FsQuotaStatus enumeration.
 */
enum FsQuotaStatus: string
{
    case Disabled = 'disabled';

    case Enabling = 'enabling';

    case Enabled = 'enabled';
}
