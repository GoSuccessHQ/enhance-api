<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerUptime schema.
 */
class ServerUptime extends AbstractDto
{
    public ?int $uptime = null;
}
