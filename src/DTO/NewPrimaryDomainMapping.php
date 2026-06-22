<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewPrimaryDomainMapping schema.
 */
class NewPrimaryDomainMapping extends AbstractDto
{
    public ?string $domainId = null;

    public ?CanonicalRedirect $canonicalRedirect = null;
}
