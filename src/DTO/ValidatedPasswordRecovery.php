<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ValidatedPasswordRecovery schema.
 */
class ValidatedPasswordRecovery extends AbstractDto
{
    public ?string $obfuscatedEmail = null;
}
