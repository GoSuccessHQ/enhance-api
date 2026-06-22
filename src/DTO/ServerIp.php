<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerIp schema.
 */
class ServerIp extends AbstractDto
{
    public ?string $ip = null;

    public ?bool $isPrimary = null;
}
