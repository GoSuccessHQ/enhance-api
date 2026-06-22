<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NetworkInterface schema.
 */
class NetworkInterface extends AbstractDto
{
    public ?string $name = null;

    public ?InterfaceIp $ips = null;
}
