<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewPassword schema.
 */
class NewPassword extends AbstractDto
{
    public ?string $newPassword = null;
}
