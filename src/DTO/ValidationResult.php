<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ValidationResult schema.
 */
class ValidationResult extends AbstractDto
{
    public ?bool $result = null;
}
