<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\LogLevelLimit;

/**
 * Settings for orchd logging
 */
class OrchdLogSettings extends AbstractDto
{
    public ?LogLevelLimit $limit = null;
}
