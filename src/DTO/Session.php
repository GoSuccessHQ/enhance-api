<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Session schema.
 */
class Session extends AbstractDto
{
    public ?string $id = null;

    public ?string $createdAt = null;

    public ?string $userAgent = null;

    public ?string $ipAddr = null;

    public ?string $location = null;
}
