<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * Resolved = domain resolves to our servers. ForeignServer = domain resolves but points to somewhere else. Failed = DNS query failed for the domain (potentially not configured). Unknown = Not queried. Error = There was an internal error. Mixed = Website's domains resolved with different statuses.
 */
enum DnsStatus: string
{
    case Resolved = 'Resolved';

    case ForeignServer = 'ForeignServer';

    case Failed = 'Failed';

    case Mixed = 'Mixed';

    case Unknown = 'Unknown';

    case Error = 'Error';
}
