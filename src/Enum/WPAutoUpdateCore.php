<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The WPAutoUpdateCore enumeration.
 */
enum WPAutoUpdateCore: string
{
    case Major = 'major';

    case Minor = 'minor';
}
