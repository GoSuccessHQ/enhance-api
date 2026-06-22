<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SubscriptionDedicatedServersInfo schema.
 */
class SubscriptionDedicatedServersInfo extends AbstractDto
{
    public ?SubscriptionDedicatedServer $appServer = null;

    public ?SubscriptionDedicatedServer $backupServer = null;

    public ?SubscriptionDedicatedServer $dbServer = null;

    public ?SubscriptionDedicatedServer $emailServer = null;

    public ?SubscriptionDedicatedServer $postgresqlServer = null;
}
