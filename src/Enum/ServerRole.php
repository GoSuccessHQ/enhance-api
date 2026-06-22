<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The ServerRole enumeration.
 */
enum ServerRole: string
{
    case Email = 'email';

    case Backup = 'backup';

    case Database = 'database';

    case Application = 'application';

    case Dns = 'dns';

    case Postgresql = 'postgresql';
}
