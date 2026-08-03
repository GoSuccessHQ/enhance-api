<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\PlanType;

/**
 * DTO for the UpdatePlan schema.
 */
class UpdatePlan extends AbstractDto
{
    public ?string $name = null;

    public ?PlanType $planType = null;

    public ?CgroupLimits $cgroupLimits = null;

    public ?FsQuotaLimit $fsQuotaLimit = null;

    /** @var array<int, \GoSuccess\Enhance\Enum\PhpVersion> */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\PhpVersion::class)]
    public ?array $allowedPhpVersions = null;

    /** If unset, all current and future apps are allowed. Accepts an array of {@see \GoSuccess\Enhance\Enum\WebsiteAppKind} or an {@see UnsetType}. */
    public mixed $allowedApps = null;

    public ?PhpVersion $defaultPhpVersion = null;

    public ?bool $redisAllowed = null;

    /**
     * If provided as an empty array, removes all server groups from the plan.
     * @var string[]
     */
    #[ArrayItemType('string')]
    public ?array $serverGroupIds = null;

    /** Whether the customer can select the server group for their websites. */
    public ?bool $allowServerGroupSelection = null;

    /** If set, servers from this server group are prioritized by placement algorithm. If no server from the default server group is available, servers from other server groups are tried. If both serverGroupIds and defaultServerGroupId is provided, defaultServerGroupId will be added to serverGroupIds if not there. If only defaultServerGroupId is provided, already existing plan's serverGroupIds will be expanded with defaultServerGroupId if not there yet. */
    public mixed $defaultServerGroupId = null;

    /** :> When WordPress is installed on a website under this plan, the chosen theme will be preinstalled. */
    public mixed $preinstallWordpressTheme = null;

    public ?bool $persistentAppsAllowed = null;
}
