<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the EmailAddress schema.
 */
class EmailAddress extends AbstractDto
{
    public ?string $email = null;
}
