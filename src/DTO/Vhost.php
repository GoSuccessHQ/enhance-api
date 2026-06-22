<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\VhostWebserverKind;

/**
 * DTO for the Vhost schema.
 */
class Vhost extends AbstractDto
{
    public ?string $contents = null;

    public ?VhostWebserverKind $webserver = null;
}
