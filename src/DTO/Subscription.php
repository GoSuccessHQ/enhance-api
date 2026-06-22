<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\PlanType;
use GoSuccess\Enhance\Enum\Status;

/**
 * An organization's subscription to a plan. This allows the subscriber to use the subscribed to resources up until the quota defined in the plan is exhausted. Includes details about the subscription as well as the current usage of the resources.
 */
class Subscription extends AbstractDto
{
    public ?int $id = null;

    public ?int $planId = null;

    public ?string $planName = null;

    public ?string $subscriberId = null;

    public ?string $vendorId = null;

    public ?Status $status = null;

    public ?string $suspendedBy = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\UsedResource> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\UsedResource::class)]
    public ?array $resources = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Allowance> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Allowance::class)]
    public ?array $allowances = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Selection> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Selection::class)]
    public ?array $selections = null;

    public ?SubscriptionDedicatedServersInfo $dedicatedServers = null;

    public ?PlanType $planType = null;

    /** @var array<int, \GoSuccess\Enhance\Enum\PhpVersion> */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\PhpVersion::class)]
    public ?array $allowedPhpVersions = null;

    public ?PhpVersion $defaultPhpVersion = null;

    public ?bool $redisAllowed = null;

    /**
     * If this field is present, the customer is allowed to chose from the server groups listed here when creating a website.
     * @var array<int, \GoSuccess\Enhance\DTO\ServerGroup>
     */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerGroup::class)]
    public ?array $serverGroups = null;

    /** :> When WordPress is installed on a website under this plan, the chosen theme will be preinstalled. */
    public ?string $preinstallWordpressTheme = null;

    public ?string $friendlyName = null;

    public ?bool $persistentAppsAllowed = null;
}
