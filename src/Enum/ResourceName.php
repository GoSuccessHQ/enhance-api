<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The name of the resource. Must be unique within a plan.
 * Note: for arbitrary string casting please use `camelCase` format
 */
enum ResourceName: string
{
    case Customers = 'customers';

    case Diskspace = 'diskspace';

    case DomainAliases = 'domainAliases';

    case Forwarders = 'forwarders';

    case FtpUsers = 'ftpUsers';

    case Mailboxes = 'mailboxes';

    case MysqlDbs = 'mysqlDbs';

    case PageViews = 'pageViews';

    case StagingWebsites = 'stagingWebsites';

    case Transfer = 'transfer';

    case Websites = 'websites';

    case AddonDomains = 'addonDomains';

    case Subdomains = 'subdomains';

    case DnsRecords = 'dnsRecords';

    case PostgresqlDbs = 'postgresqlDbs';

    case Processes = 'processes';
}
