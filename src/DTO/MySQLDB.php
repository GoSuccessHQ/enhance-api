<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MySQLDB schema.
 */
class MySQLDB extends AbstractDto
{
    public ?string $name = null;

    public ?int $size = null;

    public ?string $createdAt = null;

    public ?float $userCount = null;
}
