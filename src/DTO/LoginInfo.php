<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the LoginInfo schema.
 */
class LoginInfo extends AbstractDto
{
    public ?string $email = null;

    public ?string $password = null;

    public ?string $name = null;
}
