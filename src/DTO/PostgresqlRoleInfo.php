<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRoleState;

/**
 * DTO for the PostgresqlRoleInfo schema.
 */
class PostgresqlRoleInfo extends AbstractDto
{
    public ?ServerRoleState $state = null;

    public ?int $usage = null;

    /** The number of websites whose databases are assigned to be on this PostgreSQL role. */
    public ?int $websitesCount = null;
}
