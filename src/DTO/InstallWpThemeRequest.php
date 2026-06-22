<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the InstallWpThemeRequest schema.
 */
class InstallWpThemeRequest extends AbstractDto
{
    public ?string $name = null;

    /** Activate theme after installation */
    public ?bool $activate = null;
}
