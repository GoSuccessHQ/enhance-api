<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Quota schema.
 */
class Quota extends AbstractDto
{
    public ?int $usage = null;

    public ?int $total = null;
}
