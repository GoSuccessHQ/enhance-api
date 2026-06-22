<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Blocked schema.
 */
class Blocked extends AbstractDto
{
    public ?int $blockedUntil = null;

    public ?int $currentFailures = null;

    public ?int $allFailures = null;
}
