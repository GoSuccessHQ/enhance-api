<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the CrontabFullListing schema.
 */
class CrontabFullListing extends AbstractDto
{
    /** @var array<int, mixed> */
    public ?array $items = null;
}
