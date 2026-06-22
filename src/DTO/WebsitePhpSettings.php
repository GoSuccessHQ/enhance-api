<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsitePhpSettings schema.
 */
class WebsitePhpSettings extends AbstractDto
{
    public ?string $websiteId = null;

    public ?PhpIni $phpIni = null;
}
