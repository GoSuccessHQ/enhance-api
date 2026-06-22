<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UpdateMember schema.
 */
class UpdateMember extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\Enum\Role> */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\Role::class)]
    public ?array $roles = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $siteAccesses = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $notifications = null;
}
