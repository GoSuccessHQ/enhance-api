<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the PostgresqlUserUpdate schema.
 */
class PostgresqlUserUpdate extends AbstractDto
{
    public ?string $password = null;
}
