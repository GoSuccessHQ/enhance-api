<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MySQLUserUpdate schema.
 */
class MySQLUserUpdate extends AbstractDto
{
    public ?string $password = null;
}
