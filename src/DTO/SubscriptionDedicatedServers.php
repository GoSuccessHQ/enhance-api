<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SubscriptionDedicatedServers schema.
 */
class SubscriptionDedicatedServers extends AbstractDto
{
    public ?string $appServerId = null;

    public ?string $backupServerId = null;

    public ?string $dbServerId = null;

    public ?string $emailServerId = null;

    public ?string $postgresqlServerId = null;
}
