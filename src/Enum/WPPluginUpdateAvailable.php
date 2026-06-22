<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The WPPluginUpdateAvailable enumeration.
 */
enum WPPluginUpdateAvailable: string
{
    case Available = 'available';

    case None = 'none';
}
