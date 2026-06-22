<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The EmailStatus enumeration.
 */
enum EmailStatus: string
{
    case Active = 'active';

    case Disabled = 'disabled';

    case Deleted = 'deleted';

    case Suspended = 'suspended';
}
