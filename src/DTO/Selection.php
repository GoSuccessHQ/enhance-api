<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Selection schema.
 */
class Selection extends AbstractDto
{
    public ?string $name = null;

    public ?string $value = null;
}
