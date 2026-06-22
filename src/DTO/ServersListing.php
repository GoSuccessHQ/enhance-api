<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServersListing schema.
 */
class ServersListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\ServerInfoBrief> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerInfoBrief::class)]
    public ?array $items = null;

    public ?int $total = null;
}
