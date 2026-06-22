<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ResourceCheckConflictKind;

/**
 * DTO for the ResourceCheckConflict schema.
 */
class ResourceCheckConflict extends AbstractDto
{
    public ?ResourceCheckConflictKind $kind = null;

    public ?string $id = null;

    public ?string $name = null;
}
