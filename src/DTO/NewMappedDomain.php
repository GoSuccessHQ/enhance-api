<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\DomainMappingKind;

/**
 * DTO for the NewMappedDomain schema.
 */
class NewMappedDomain extends AbstractDto
{
    public ?string $domain = null;

    public ?string $documentRoot = null;

    public ?DomainMappingKind $kind = null;
}
