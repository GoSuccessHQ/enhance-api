<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SessionsFullListing schema.
 */
class SessionsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Session> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Session::class)]
    public ?array $items = null;
}
