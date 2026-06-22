<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Enable or disable debug display.
 */
class WpDebugDisplay extends AbstractDto
{
    public ?bool $WpDebugDisplay = null;
}
