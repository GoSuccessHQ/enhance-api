<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The WPPluginAutoUpdateStatus enumeration.
 */
enum WPPluginAutoUpdateStatus: string
{
    case Enabled = 'enabled';

    case Disabled = 'disabled';
}
