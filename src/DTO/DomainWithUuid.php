<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DomainWithUuid schema.
 */
class DomainWithUuid extends AbstractDto
{
    public ?string $domainId = null;

    public ?string $domainName = null;

    public ?bool $isPrimary = null;
}
