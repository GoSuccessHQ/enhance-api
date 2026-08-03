<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the OpenclawDeviceList schema.
 */
class OpenclawDeviceList extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\OpenclawDevice> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\OpenclawDevice::class)]
    public ?array $pending = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\OpenclawDevice> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\OpenclawDevice::class)]
    public ?array $paired = null;
}
