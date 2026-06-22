<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the EmailPublicIp schema.
 */
class EmailPublicIp extends AbstractDto
{
    public ?string $ipAddress = null;
}
