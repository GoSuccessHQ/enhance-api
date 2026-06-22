<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\MySQLAuthPlugin;

/**
 * DTO for the NewMySQLUser schema.
 */
class NewMySQLUser extends AbstractDto
{
    public ?string $username = null;

    public ?string $password = null;

    public ?MySQLAuthPlugin $authPlugin = null;
}
