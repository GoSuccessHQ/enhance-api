<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the InstallCmd schema.
 */
class InstallCmd extends AbstractDto
{
    public ?string $cmd = null;
}
