<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The SettingKind enumeration.
 */
enum SettingKind: string
{
    case PhpIni = 'phpIni';

    case PhpFpm = 'phpFpm';

    case Apache = 'apache';

    case Postfix = 'postfix';

    case Sged = 'sged';

    case Rspamd = 'rspamd';

    case Dovecot = 'dovecot';

    case WebsiteBackup = 'websiteBackup';

    case Screenshotd = 'screenshotd';

    case HardDeleteGC = 'hardDeleteGC';

    case Letsencrypt = 'letsencrypt';
}
