<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The WebsiteStatus enumeration.
 */
enum WebsiteStatus: string
{
    case Active = 'active';

    case Disabled = 'disabled';

    case Deleted = 'deleted';
}
