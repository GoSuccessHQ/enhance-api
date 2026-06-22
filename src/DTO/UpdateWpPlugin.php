<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WPPluginAutoUpdateStatus;
use GoSuccess\Enhance\Enum\WPPluginStatus;

/**
 * DTO for the UpdateWpPlugin schema.
 */
class UpdateWpPlugin extends AbstractDto
{
    public ?WPPluginStatus $status = null;

    public ?WPPluginAutoUpdateStatus $autoUpdate = null;
}
