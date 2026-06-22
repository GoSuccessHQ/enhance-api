<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerSniMappingBody schema.
 */
class ServerSniMappingBody extends AbstractDto
{
    public ?string $certId = null;

    public ?string $hostname = null;
}
