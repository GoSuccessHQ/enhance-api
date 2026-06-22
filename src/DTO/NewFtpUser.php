<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewFtpUser schema.
 */
class NewFtpUser extends AbstractDto
{
    public ?string $account = null;

    public ?string $password = null;

    public ?string $homeDir = null;
}
