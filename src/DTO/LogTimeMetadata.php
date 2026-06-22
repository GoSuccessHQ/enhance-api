<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * How long the request took. It's used with `ok` and `slow` log statuses.
 */
class LogTimeMetadata extends AbstractDto
{
    public ?int $requestTimeMs = null;
}
