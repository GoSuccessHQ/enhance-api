<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the BackupOptions schema.
 */
class BackupOptions extends AbstractDto
{
    public ?string $description = null;
}
