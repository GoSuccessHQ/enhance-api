<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the LoginsListing schema.
 */
class LoginsListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Login> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Login::class)]
    public ?array $items = null;

    public ?int $total = null;
}
