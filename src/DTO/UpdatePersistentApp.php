<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\PersistentAppStartMode;

/**
 * DTO for the UpdatePersistentApp schema.
 */
class UpdatePersistentApp extends AbstractDto
{
    public mixed $proxyDetails = null;

    public ?PersistentAppStartMode $startMode = null;

    public ?string $command = null;

    public ?string $workingDirectory = null;

    public mixed $nodeVersion = null;
}
