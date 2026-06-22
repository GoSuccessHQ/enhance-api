<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\LicenceStatus;

/**
 * Enhance Licence information with its status and key (if set)
 */
class LicenceInfo extends AbstractDto
{
    public ?string $key = null;

    public ?LicenceStatus $status = null;
}
