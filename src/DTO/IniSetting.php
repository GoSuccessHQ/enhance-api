<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the IniSetting schema.
 */
class IniSetting extends AbstractDto
{
    public ?string $key = null;

    public ?string $value = null;

    public ?string $section = null;
}
