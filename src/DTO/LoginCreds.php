<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the LoginCreds schema.
 */
class LoginCreds extends AbstractDto
{
    public ?string $email = null;

    public ?string $password = null;

    public ?string $deviceId = null;
}
