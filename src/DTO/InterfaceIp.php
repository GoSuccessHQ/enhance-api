<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the InterfaceIp schema.
 */
class InterfaceIp extends AbstractDto
{
    public ?string $ip = null;

    public ?string $prefix = null;

    public ?string $kind = null;
}
