<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the FtpUser schema.
 */
class FtpUser extends AbstractDto
{
    public ?string $account = null;

    /** Homedir must be a relative path to the website's base dir. Set to empty string to use website base dir as FtpUser's home. */
    public ?string $homeDir = null;
}
