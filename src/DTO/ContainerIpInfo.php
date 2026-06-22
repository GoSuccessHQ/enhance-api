<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ContainerIpInfo schema.
 */
class ContainerIpInfo extends AbstractDto
{
    public ?string $containerIp = null;

    public ?string $hostIp = null;
}
