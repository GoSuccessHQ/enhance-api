<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ControlRoleInfo schema.
 */
class ControlRoleInfo extends AbstractDto
{
    public ?int $usage = null;

    public ?CoreServiceInfo $authd = null;

    public ?CoreServiceInfo $sged = null;

    public ?CoreServiceInfo $logd = null;
}
