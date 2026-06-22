<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DatabaseBackupWithSize schema.
 */
class DatabaseBackupWithSize extends AbstractDto
{
    public ?string $name = null;

    public ?float $size = null;
}
