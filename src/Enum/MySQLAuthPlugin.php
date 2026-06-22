<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * See https://dev.mysql.com/doc/refman/8.0/en/authentication-plugins.html for list of plugins which MySQL supports. If not provided, the user will use whatever defaults the mysql server it's being created uses.
 */
enum MySQLAuthPlugin: string
{
    case CachingSha2Password = 'caching_sha2_password';

    case MysqlNativePassword = 'mysql_native_password';
}
