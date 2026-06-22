<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerSpecs schema.
 */
class ServerSpecs extends AbstractDto
{
    public ?string $cpuKind = null;

    public ?float $cpuMhz = null;

    public ?float $cpuCores = null;

    public ?string $architecture = null;

    public ?string $os = null;
}
