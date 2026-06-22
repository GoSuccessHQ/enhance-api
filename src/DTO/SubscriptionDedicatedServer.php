<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SubscriptionDedicatedServer schema.
 */
class SubscriptionDedicatedServer extends AbstractDto
{
    public ?string $name = null;

    public ?string $id = null;

    public ?string $ip = null;
}
