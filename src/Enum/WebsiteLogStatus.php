<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The status of the website at the time the log was written. Some statuses have additional metadata (ok, slow, failed4xx, failed5xx) whereas some don't (timeout, dnsZoneNotFound, appServerMismatch).
 */
enum WebsiteLogStatus: string
{
    case Ok = 'ok';

    case Slow = 'slow';

    case Failed4xx = 'failed4xx';

    case Failed5xx = 'failed5xx';

    case Timeout = 'timeout';

    case DnsZoneNotFound = 'dnsZoneNotFound';

    case AppServerMismatch = 'appServerMismatch';
}
