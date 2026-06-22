<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the PersistentAppProxyDetails schema.
 */
class PersistentAppProxyDetails extends AbstractDto
{
    public ?string $path = null;

    public ?int $port = null;

    public ?bool $allowWebSocketUpgrade = null;
}
