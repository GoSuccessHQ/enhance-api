<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Login2FA schema.
 */
class Login2FA extends AbstractDto
{
    public ?string $authMethod = null;

    public ?string $pin = null;

    /** @var array<string, mixed> */
    public ?array $rememberMe = null;
}
