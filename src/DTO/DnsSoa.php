<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DnsSoa schema.
 */
class DnsSoa extends AbstractDto
{
    public ?string $adminEmail = null;

    public ?string $nameServer = null;

    public ?int $expire = null;

    public ?int $refresh = null;

    public ?int $retry = null;

    /** In seconds */
    public ?int $ttl = null;
}
