<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The ServerRoleState enumeration.
 */
enum ServerRoleState: string
{
    case Enabled = 'enabled';

    case Disabled = 'disabled';
}
