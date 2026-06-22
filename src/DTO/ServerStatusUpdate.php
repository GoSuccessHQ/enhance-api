<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerStatusUpdate schema.
 */
class ServerStatusUpdate extends AbstractDto
{
    public ?bool $isDecommissioned = null;
}
