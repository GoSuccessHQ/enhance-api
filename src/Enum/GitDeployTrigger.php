<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The GitDeployTrigger enumeration.
 */
enum GitDeployTrigger: string
{
    case Manual = 'manual';

    case Automatic = 'automatic';
}
