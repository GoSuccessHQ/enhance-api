<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ResourceCheckManagerErrorKind;
use GoSuccess\Enhance\Enum\ResourceName;

/**
 * DTO for the ResourceCheckManagerError schema.
 */
class ResourceCheckManagerError extends AbstractDto
{
    public ?ResourceCheckManagerErrorKind $kind = null;

    public ?ResourceName $resourceName = null;

    public ?int $total = null;

    public ?int $usage = null;

    public ?int $requested = null;
}
