<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ResourceCountByInterval schema.
 */
class ResourceCountByInterval extends AbstractDto
{
    public ?string $interval = null;

    public ?float $resourceCount = null;
}
