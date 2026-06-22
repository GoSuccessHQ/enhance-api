<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ProcessInfo schema.
 */
class ProcessInfo extends AbstractDto
{
    public ?int $pid = null;

    public ?string $name = null;

    public ?float $cpu_usage = null;

    public ?int $resMemory = null;
}
