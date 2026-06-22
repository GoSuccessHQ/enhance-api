<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The RoleInstallationState enumeration.
 */
enum RoleInstallationState: string
{
    case Enabled = 'enabled';

    case Disabled = 'disabled';

    case NotInstalled = 'notInstalled';
}
