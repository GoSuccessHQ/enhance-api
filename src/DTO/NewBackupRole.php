<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * The path for backups to be stored.
 */
class NewBackupRole extends AbstractDto
{
    /** The full path where the backups will be stored. */
    public ?string $path = null;
}
