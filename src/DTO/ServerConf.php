<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerConf schema.
 */
class ServerConf extends AbstractDto
{
    public ?string $friendlyName = null;

    public ?string $group = null;
}
