<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerGroup schema.
 */
class ServerGroup extends AbstractDto
{
    public ?string $id = null;

    public ?string $name = null;

    public ?float $serverCount = null;

    public ?string $createdAt = null;
}
