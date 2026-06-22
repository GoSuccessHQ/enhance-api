<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\DomainMappingKind;

/**
 * DTO for the ActivityDomainEntityDetail schema.
 */
class ActivityDomainEntityDetail extends AbstractDto
{
    public ?string $name = null;

    public ?string $orgId = null;

    public ?string $websiteId = null;

    public ?DomainMappingKind $mappingKind = null;
}
