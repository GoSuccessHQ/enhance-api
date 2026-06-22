<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerGroups schema.
 */
class ServerGroups extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\ServerGroup> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerGroup::class)]
    public ?array $items = null;
}
