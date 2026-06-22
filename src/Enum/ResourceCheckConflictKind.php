<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The ResourceCheckConflictKind enumeration.
 */
enum ResourceCheckConflictKind: string
{
    case MysqlUser = 'mysqlUser';

    case MysqlDb = 'mysqlDb';

    case FtpUser = 'ftpUser';

    case MailboxForwarder = 'mailboxForwarder';

    case Mailbox = 'mailbox';

    case Domain = 'domain';
}
