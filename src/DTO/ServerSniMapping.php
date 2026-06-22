<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerSniMapping schema.
 */
class ServerSniMapping extends AbstractDto
{
    public ?string $serverId = null;

    public ?string $certId = null;

    public ?string $hostname = null;
}
