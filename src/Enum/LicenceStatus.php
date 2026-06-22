<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * Enhance Licence status
 */
enum LicenceStatus: string
{
    case Active = 'active';

    case Cancelled = 'cancelled';

    case Suspended = 'suspended';

    case Trial = 'trial';

    case Unpaid = 'unpaid';

    case Unknown = 'unknown';
}
