<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\PlanType;

/**
 * DTO for the NewPlan schema.
 */
class NewPlan extends AbstractDto
{
    public ?string $name = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Resource> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Resource::class)]
    public ?array $resources = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Allowance> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Allowance::class)]
    public ?array $allowances = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Selection> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Selection::class)]
    public ?array $selections = null;

    public ?string $serverGroupId = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $serverGroupIds = null;

    public ?bool $allowServerGroupSelection = null;

    public ?PlanType $planType = null;

    public ?CgroupLimits $cgroupLimits = null;

    public ?FsQuotaLimit $fsQuotaLimit = null;

    /** @var array<int, \GoSuccess\Enhance\Enum\PhpVersion> */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\PhpVersion::class)]
    public ?array $allowedPhpVersions = null;

    /**
     * If unset, all current and future apps are allowed.
     * @var array<int, \GoSuccess\Enhance\Enum\WebsiteAppKind>
     */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\WebsiteAppKind::class)]
    public ?array $allowedApps = null;

    public ?PhpVersion $defaultPhpVersion = null;

    public ?bool $redisAllowed = null;

    /** If set, servers from this server group are prioritized by placement algorithm. If no server from the default server group is available, servers from other server groups are tried. The defaultServerGroupId will be automatically added to serverGroupIds if they do not contain it or are not provided. */
    public ?string $defaultServerGroupId = null;

    /** :> When WordPress is installed on a website under this plan, the chosen theme will be preinstalled. */
    public ?string $preinstallWordpressTheme = null;

    public ?bool $persistentAppsAllowed = null;
}
