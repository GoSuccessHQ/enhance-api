<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WordPressInfo schema.
 */
class WordPressInfo extends AbstractDto
{
    public ?string $version = null;

    /** From the WordPress database, ignores wp-config.php overrides */
    public ?string $site_url = null;

    public ?float $plugin_count = null;

    public ?float $user_count = null;

    public ?bool $has_woocommerce = null;
}
