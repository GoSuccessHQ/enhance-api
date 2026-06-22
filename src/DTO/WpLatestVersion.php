<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WpLatestVersion schema.
 */
class WpLatestVersion extends AbstractDto
{
    public ?string $version = null;
}
