<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The PersistentAppStartMode enumeration.
 */
enum PersistentAppStartMode: string
{
    case Automatic = 'automatic';

    case Manual = 'manual';
}
