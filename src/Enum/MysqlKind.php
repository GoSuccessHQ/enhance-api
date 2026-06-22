<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The MysqlKind enumeration.
 */
enum MysqlKind: string
{
    case Mysql80 = 'mysql80';

    case Mysql81 = 'mysql81';

    case MariaDbLts = 'mariaDbLts';

    case MariaDb11 = 'mariaDb11';
}
