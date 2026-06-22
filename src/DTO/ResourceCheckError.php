<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ResourceCheckError schema.
 */
class ResourceCheckError extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\ResourceCheckConflict> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ResourceCheckConflict::class)]
    public ?array $conflicts = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\ResourceCheckManagerError> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ResourceCheckManagerError::class)]
    public ?array $resources = null;
}
