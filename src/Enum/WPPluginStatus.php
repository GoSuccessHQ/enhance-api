<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The WPPluginStatus enumeration.
 */
enum WPPluginStatus: string
{
    case Active = 'active';

    case Inactive = 'inactive';

    case Unknown = 'unknown';
}
