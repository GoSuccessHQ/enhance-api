<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\BackupAction;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\WebsiteKind;
use GoSuccess\Enhance\Enum\WebsiteStatus;

/**
 * DTO for the Website schema.
 */
class Website extends AbstractDto
{
    public ?string $id = null;

    public ?WebsiteDomain $domain = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\WebsiteDomain> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\WebsiteDomain::class)]
    public ?array $aliases = null;

    /** @var array<int, mixed> */
    public ?array $subdomains = null;

    public ?float $subscriptionId = null;

    public ?float $planId = null;

    public ?string $plan = null;

    public ?WebsiteStatus $status = null;

    public ?string $suspendedBy = null;

    public ?string $colorCode = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Tag> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Tag::class)]
    public ?array $tags = null;

    public ?int $size = null;

    public ?string $orgId = null;

    public ?string $org = null;

    public ?WebsiteKind $kind = null;

    public ?BackupAction $pendingBackup = null;

    public ?string $parent = null;

    public ?string $parentId = null;

    /** The id of the server on which this website is located. This is only returned when websites are queried recursively by an MO member, as the MO is in charge of servers and thus this information only concerns them. */
    public ?string $appServerId = null;

    /** The id of the server on which the backups of this website are located. This is only returned when websites are queried recursively by an MO member, as the MO is in charge of servers and thus this information only concerns them. */
    public ?string $backupServerId = null;

    /** The id of the server on which the databases of this website are located. This is only returned when websites are queried recursively by an MO member, as the MO is in charge of servers and thus this information only concerns them. */
    public ?string $dbServerId = null;

    /** The id of the server on which the emails of this website are located. This is only returned when websites are queried recursively by an MO member, as the MO is in charge of servers and thus this information only concerns them. */
    public ?string $emailServerId = null;

    public ?string $postgresqlServerId = null;

    /** The unix user assigned to this website, used for ssh shells, prefixing website databases and databse users, etc. */
    public ?string $unixUser = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\SiteAccessMember> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\SiteAccessMember::class)]
    public ?array $siteAccessMembers = null;

    /**
     * The addresses of the the server on which this website is located.
     * @var array<int, \GoSuccess\Enhance\DTO\ServerIp>
     */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerIp::class)]
    public ?array $serverIps = null;

    /**
     * The addresses of the the server on which this website's backups are located.
     * @var array<int, \GoSuccess\Enhance\DTO\ServerIp>
     */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerIp::class)]
    public ?array $backupServerIps = null;

    /**
     * The addresses of the the server on which this website's databases are located.
     * @var array<int, \GoSuccess\Enhance\DTO\ServerIp>
     */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerIp::class)]
    public ?array $dbServerIps = null;

    /**
     * The addresses of the the server on which this website's PostgreSQL databases are located.
     * @var array<int, \GoSuccess\Enhance\DTO\ServerIp>
     */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerIp::class)]
    public ?array $postgresqlServerIps = null;

    /**
     * The addresses of the the server on which this website's emails are located.
     * @var array<int, \GoSuccess\Enhance\DTO\ServerIp>
     */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerIp::class)]
    public ?array $emailServerIps = null;

    /** The path relative to the control panel domain where filerd can be accessed. */
    public ?string $filerdAddress = null;

    /** If PHP is enabled, this represents the PHP version installed for the website. */
    public ?PhpVersion $phpVersion = null;

    /** The date the site was first added */
    public ?string $createdAt = null;

    public ?string $appServerName = null;

    public ?string $dbServerName = null;

    public ?string $emailServerName = null;

    public ?string $backupServerName = null;

    public ?CanUse $canUse = null;

    public ?string $appServerIpv6 = null;

    public ?string $dbServerIpv6 = null;

    public ?string $postgresqlServerIpv6 = null;

    public ?string $emailServerIpv6 = null;
}
