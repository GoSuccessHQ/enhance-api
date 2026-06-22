<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\SystemPackageName;

/**
 * DTO for the SystemPackage schema.
 */
class SystemPackage extends AbstractDto
{
    public ?SystemPackageName $name = null;
}
