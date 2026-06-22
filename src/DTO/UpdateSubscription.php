<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\Status;

/**
 * DTO for the UpdateSubscription schema.
 */
class UpdateSubscription extends AbstractDto
{
    public ?Status $status = null;

    public ?bool $isSuspended = null;

    public ?int $planId = null;

    public ?SubscriptionDedicatedServers $dedicatedServers = null;

    public ?string $friendlyName = null;
}
