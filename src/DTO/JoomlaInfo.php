<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the JoomlaInfo schema.
 */
class JoomlaInfo extends AbstractDto
{
    public ?string $version = null;

    /** Parsed from configuration.php or defaulted to the domain matching the installation path */
    public ?string $site_url = null;

    public ?float $plugin_count = null;

    public ?float $user_count = null;
}
