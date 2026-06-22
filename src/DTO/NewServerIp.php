<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewServerIp schema.
 */
class NewServerIp extends AbstractDto
{
    public ?string $ip = null;

    public ?string $prefix = null;
}
