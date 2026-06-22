<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The RoleState enumeration.
 */
enum RoleState: string
{
    case Enabled = 'enabled';

    case Disabled = 'disabled';
}
