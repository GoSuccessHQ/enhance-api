<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerIowait schema.
 */
class ServerIowait extends AbstractDto
{
    public ?float $ioWait = null;
}
