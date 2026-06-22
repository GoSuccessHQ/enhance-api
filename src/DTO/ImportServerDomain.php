<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\DomainMappingKind;

/**
 * DTO for the ImportServerDomain schema.
 */
class ImportServerDomain extends AbstractDto
{
    public ?string $importServerId = null;

    public ?string $domain = null;

    public ?DomainMappingKind $kind = null;

    public ?string $user = null;

    public ?bool $movable = null;
}
