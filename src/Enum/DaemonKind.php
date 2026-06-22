<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The DaemonKind enumeration.
 */
enum DaemonKind: string
{
    case Mysqld = 'mysqld';

    case Pdns = 'pdns';

    case PostfixSmtp = 'postfixSmtp';

    case PostfixSmtps = 'postfixSmtps';

    case PostfixSubmissions = 'postfixSubmissions';

    case DovcotImap = 'dovcotImap';

    case DovcotImaps = 'dovcotImaps';

    case DovcotPop3 = 'dovcotPop3';

    case DovcotPop3s = 'dovcotPop3s';

    case PureFtp = 'pureFtp';
}
