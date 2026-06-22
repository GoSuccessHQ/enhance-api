<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UpdateLoginResult schema.
 */
class UpdateLoginResult extends AbstractDto
{
    public ?string $otpUrl = null;

    public ?bool $verifyPin = null;
}
