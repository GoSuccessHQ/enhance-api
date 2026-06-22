<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WPPluginStatus;
use GoSuccess\Enhance\Enum\WPThemeAutoUpdateStatus;

/**
 * Describes the theme directory name and additional theme information.
 */
class WpTheme extends AbstractDto
{
    public ?string $name = null;

    public ?WPPluginStatus $status = null;

    public ?string $version = null;

    public ?string $update = null;

    public ?WPThemeAutoUpdateStatus $autoUpdate = null;
}
