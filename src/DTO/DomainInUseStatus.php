<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DomainInUseStatus schema.
 */
class DomainInUseStatus extends AbstractDto
{
    public ?string $status = null;

    public ?string $websiteId = null;
}
