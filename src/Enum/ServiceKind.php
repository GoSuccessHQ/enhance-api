<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The ServiceKind enumeration.
 */
enum ServiceKind: string
{
    case Controld = 'controld';

    case Orchd = 'orchd';

    case Authd = 'authd';

    case Logd = 'logd';

    case Sged = 'sged';

    case Bkupd = 'bkupd';

    case Mysqlcd = 'mysqlcd';

    case Dnscd = 'dnscd';

    case Filerd = 'filerd';

    case Ftpcd = 'ftpcd';
}
