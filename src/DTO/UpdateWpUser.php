<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UpdateWpUser schema.
 */
class UpdateWpUser extends AbstractDto
{
    public ?string $password = null;

    public ?string $name = null;

    public ?string $email = null;
}
