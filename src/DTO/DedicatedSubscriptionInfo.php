<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DedicatedSubscriptionInfo schema.
 */
class DedicatedSubscriptionInfo extends AbstractDto
{
    public ?float $subscriptionId = null;

    public ?string $customerOrgId = null;

    public ?string $customerOrgName = null;
}
