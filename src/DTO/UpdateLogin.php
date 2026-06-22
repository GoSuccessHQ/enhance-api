<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CPLocale;

/**
 * DTO for the UpdateLogin schema.
 */
class UpdateLogin extends AbstractDto
{
    public ?string $name = null;

    public ?string $email = null;

    public ?string $password = null;

    public ?CPLocale $locale = null;

    public ?string $authMethod = null;

    public ?string $currentPassword = null;
}
