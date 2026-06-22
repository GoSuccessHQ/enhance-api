<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WebsiteAppKind;

/**
 * DTO for the WebsiteApp schema.
 */
class WebsiteApp extends AbstractDto
{
    public ?string $id = null;

    public ?WebsiteAppKind $app = null;

    /** The path is only present if the app is installed in the root instead of a subfolder. For example if a customer installs Wordpress at '/blog', then the path will be present and equal to 'blog'. But if they install WP in website root, instead of returning '/' or empty string, this property is omitted. */
    public ?string $path = null;

    /** Only present if default was set by the user. Otherwise, this field isn't there. */
    public ?int $defaultWpUserId = null;
}
