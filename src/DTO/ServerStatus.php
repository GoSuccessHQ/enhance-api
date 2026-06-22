<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\NetworkStatus;

/**
 * DTO for the ServerStatus schema.
 */
class ServerStatus extends AbstractDto
{
    public ?NetworkStatus $status = null;
}
