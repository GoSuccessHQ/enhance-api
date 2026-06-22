<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The DnsRecordKind enumeration.
 */
enum DnsRecordKind: string
{
    case A = 'A';

    case AAAA = 'AAAA';

    case CNAME = 'CNAME';

    case TXT = 'TXT';

    case SPF = 'SPF';

    case SRV = 'SRV';

    case NS = 'NS';

    case MX = 'MX';

    case PTR = 'PTR';

    case DS = 'DS';

    case CAA = 'CAA';
}
