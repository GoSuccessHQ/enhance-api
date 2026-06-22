<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebServerRewrite schema.
 */
class WebServerRewrite extends AbstractDto
{
    public ?string $path = null;

    public ?string $destinationFile = null;
}
