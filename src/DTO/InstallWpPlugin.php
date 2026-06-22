<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the InstallWpPlugin schema.
 */
class InstallWpPlugin extends AbstractDto
{
    public ?string $pluginName = null;
}
