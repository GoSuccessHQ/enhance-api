<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the PhpIni schema.
 */
class PhpIni extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\IniSetting> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\IniSetting::class)]
    public ?array $items = null;
}
