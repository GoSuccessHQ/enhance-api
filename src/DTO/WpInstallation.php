<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WpInstallation schema.
 */
class WpInstallation extends AbstractDto
{
    public ?string $dbName = null;

    public ?string $dbUser = null;

    public ?string $tablePrefix = null;

    public ?string $path = null;
}
