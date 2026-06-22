<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the FtpUserUpdate schema.
 */
class FtpUserUpdate extends AbstractDto
{
    /** Homedir must be a relative path to the website's base dir. Set to empty string to use website base dir as FtpUser's home. */
    public ?string $homeDir = null;

    public ?string $password = null;
}
