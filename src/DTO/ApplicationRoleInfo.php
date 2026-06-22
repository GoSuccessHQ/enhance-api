<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRoleState;

/**
 * DTO for the ApplicationRoleInfo schema.
 */
class ApplicationRoleInfo extends AbstractDto
{
    public ?ServerRoleState $state = null;

    public ?int $usage = null;

    public ?ServiceInfo $filerd = null;

    public ?ServiceInfo $ftpcd = null;

    /** The number of websites that are assigned to be on this application role. */
    public ?int $websitesCount = null;
}
