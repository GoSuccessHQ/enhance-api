<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\DomainMappingKind;

/**
 * DTO for the DomainMappingUpdate schema.
 */
class DomainMappingUpdate extends AbstractDto
{
    public ?string $documentRoot = null;

    public ?DomainMappingKind $kind = null;
}
