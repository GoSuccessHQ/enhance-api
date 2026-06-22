<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The ServerMigrationSettingsAuthType enumeration.
 */
enum ServerMigrationSettingsAuthType: string
{
    case WhmToken = 'whmToken';

    case CpanelToken = 'cpanelToken';

    case Basic = 'basic';
}
