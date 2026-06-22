<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the LoginMemberships schema.
 */
class LoginMemberships extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\LoginMembership> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\LoginMembership::class)]
    public ?array $memberships = null;
}
