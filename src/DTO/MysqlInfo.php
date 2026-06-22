<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\MysqlKind;

/**
 * DTO for the MysqlInfo schema.
 */
class MysqlInfo extends AbstractDto
{
    public ?MysqlKind $mysqlKind = null;
}
