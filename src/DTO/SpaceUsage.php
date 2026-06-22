<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SpaceUsage schema.
 */
class SpaceUsage extends AbstractDto
{
    public ?int $total = null;

    public ?int $used = null;
}
