<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerLoad schema.
 */
class ServerLoad extends AbstractDto
{
    public ?float $load = null;
}
