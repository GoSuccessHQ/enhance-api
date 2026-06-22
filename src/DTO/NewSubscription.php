<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewSubscription schema.
 */
class NewSubscription extends AbstractDto
{
    public ?int $planId = null;

    public ?SubscriptionDedicatedServers $dedicatedServers = null;

    public ?string $friendlyName = null;
}
