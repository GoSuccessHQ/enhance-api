<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\MysqlKind;
use GoSuccess\Enhance\Enum\WebserverKind;

/**
 * DTO for the RolesInfo schema.
 */
class RolesInfo extends AbstractDto
{
    public ?EmailRoleInfo $email = null;

    public ?BackupRoleInfo $backup = null;

    public ?DatabaseRoleInfo $database = null;

    public ?PostgresqlRoleInfo $postgresql = null;

    public ?ApplicationRoleInfo $application = null;

    public ?DnsRoleInfo $dns = null;

    public ?WebserverKind $webserverKind = null;

    public ?MysqlKind $mysqlKind = null;
}
