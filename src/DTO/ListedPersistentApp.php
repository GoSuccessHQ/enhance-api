<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\PersistentAppStartMode;

/**
 * DTO for the ListedPersistentApp schema.
 */
class ListedPersistentApp extends AbstractDto
{
    public ?PersistentAppProxyDetails $proxyDetails = null;

    public ?PersistentAppStartMode $startMode = null;

    public ?string $command = null;

    public ?string $workingDirectory = null;

    /** @var array<string, mixed> */
    public ?array $nodeVersion = null;

    public ?string $id = null;
}
