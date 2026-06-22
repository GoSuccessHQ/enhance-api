<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Enable or disable debug logging.
 */
class WpDebugLog extends AbstractDto
{
    public ?bool $WpDebugLog = null;
}
