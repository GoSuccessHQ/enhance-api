<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRoleState;

/**
 * DTO for the DatabaseRoleInfo schema.
 */
class DatabaseRoleInfo extends AbstractDto
{
    public ?ServerRoleState $state = null;

    public ?int $usage = null;

    /** @var array<string, mixed> */
    public ?array $mysqlStats = null;

    public ?ServiceInfo $mysqlcd = null;

    /** The number of websites whose databases are assigned to be on this database role. */
    public ?int $websitesCount = null;
}
