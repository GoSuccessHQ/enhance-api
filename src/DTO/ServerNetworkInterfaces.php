<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerNetworkInterfaces schema.
 */
class ServerNetworkInterfaces extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\NetworkInterface> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\NetworkInterface::class)]
    public ?array $interfaces = null;
}
