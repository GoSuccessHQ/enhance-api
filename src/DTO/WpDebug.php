<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Enable or disable debug mode.
 */
class WpDebug extends AbstractDto
{
    public ?bool $WpDebug = null;
}
