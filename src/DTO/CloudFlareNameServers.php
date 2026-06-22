<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the CloudFlareNameServers schema.
 */
class CloudFlareNameServers extends AbstractDto
{
    public mixed $nameServers = null;

    public mixed $status = null;
}
