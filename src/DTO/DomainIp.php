<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DomainIp schema.
 */
class DomainIp extends AbstractDto
{
    public ?string $domain = null;

    public ?string $ip = null;
}
