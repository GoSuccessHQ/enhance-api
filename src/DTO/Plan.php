<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\PlanType;

/**
 * A plan (or sometimes referred to as a package) defines a set of resources a reseller can offer for customer organizations to subscribe to.
 */
class Plan extends AbstractDto
{
    public ?int $id = null;

    public ?string $name = null;

    public ?string $orgId = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Resource> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Resource::class)]
    public ?array $resources = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Allowance> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Allowance::class)]
    public ?array $allowances = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Selection> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Selection::class)]
    public ?array $selections = null;

    /** The number of subscriptions to this plan. */
    public ?int $subscriptionsCount = null;

    /** Use serverGroupIds instead */
    public ?string $serverGroupId = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $serverGroupIds = null;

    /** Whether the customer can select the server group for their websites. */
    public ?bool $allowServerGroupSelection = null;

    public ?string $createdAt = null;

    public ?PlanType $planType = null;

    public ?CgroupLimits $cgroupLimits = null;

    public ?FsQuotaLimit $fsQuotaLimit = null;

    /** @var array<int, \GoSuccess\Enhance\Enum\PhpVersion> */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\PhpVersion::class)]
    public ?array $allowedPhpVersions = null;

    public ?PhpVersion $defaultPhpVersion = null;

    public ?bool $redisAllowed = null;

    /** :> When WordPress is installed on a website under this plan, the chosen theme will be preinstalled. */
    public ?string $preinstallWordpressTheme = null;

    public ?bool $persistentAppsAllowed = null;
}
