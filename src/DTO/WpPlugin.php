<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WPPluginAutoUpdateStatus;
use GoSuccess\Enhance\Enum\WPPluginStatus;
use GoSuccess\Enhance\Enum\WPPluginUpdateAvailable;

/**
 * Describes the filename and additional plugin information. The filename is the name of the plugin php file, e.g. "bbpress.php". If the plugin kind is "file", then the file name refers to e.g. "wp-content/plugins/bbpress.php". If the kind is "dir", then the name refers to "wp-content/plugins/bbpress/bbpress.php". The name of the dir is always the same as the name of the file without the php suffix.
 * https://developer.wordpress.org/plugins/plugin-basics/header-requirements/#header-fields
 */
class WpPlugin extends AbstractDto
{
    public ?string $name = null;

    public ?string $uri = null;

    public ?string $description = null;

    public ?string $version = null;

    public ?WPPluginUpdateAvailable $update = null;

    public ?WPPluginAutoUpdateStatus $autoUpdate = null;

    public ?WPPluginStatus $status = null;

    public ?string $author = null;
}
