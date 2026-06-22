<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UpdateDnsZone schema.
 */
class UpdateDnsZone extends AbstractDto
{
    public ?string $nameServer = null;

    public ?string $adminEmail = null;

    public ?int $expire = null;

    public ?int $refresh = null;

    public ?int $retry = null;

    /** In seconds */
    public ?int $ttl = null;
}
