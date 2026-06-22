<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Setting schema.
 */
class Setting extends AbstractDto
{
    public ?string $name = null;

    /** An arbitrary JSON serializable value. */
    public mixed $value = null;
}
