<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the EmailPasswordUpdate schema.
 */
class EmailPasswordUpdate extends AbstractDto
{
    public ?string $password = null;
}
