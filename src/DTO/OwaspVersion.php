<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the OwaspVersion schema.
 */
class OwaspVersion extends AbstractDto
{
    public ?string $current = null;

    public ?string $available = null;
}
