<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The LogKind enumeration.
 */
enum LogKind: string
{
    case Migration = 'migration';

    case Website = 'website';

    case WebsitePrimaryDomain = 'websitePrimaryDomain';

    case WebsiteSecondyDomain = 'websiteSecondyDomain';

    case WebsiteHomeDir = 'websiteHomeDir';

    case MysqlDb = 'mysqlDb';

    case MysqlUser = 'mysqlUser';

    case MysqlAccessHost = 'mysqlAccessHost';

    case MysqlGrant = 'mysqlGrant';

    case Cron = 'cron';

    case Ftp = 'ftp';

    case FtpUser = 'ftpUser';

    case Email = 'email';

    case EmailForwarder = 'emailForwarder';

    case EmailAccount = 'emailAccount';

    case EmailData = 'emailData';

    case EmailDataTransfer = 'emailDataTransfer';
}
