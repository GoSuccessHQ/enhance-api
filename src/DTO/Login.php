<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CPLocale;

/**
 * DTO for the Login schema.
 */
class Login extends AbstractDto
{
    public ?string $id = null;

    public ?string $email = null;

    public ?string $name = null;

    public ?string $colorCode = null;

    public ?string $registeredAt = null;

    public ?string $avatarPath = null;

    public ?string $passwordLastChangedAt = null;

    public ?string $authMethod = null;

    public ?CPLocale $locale = null;
}
