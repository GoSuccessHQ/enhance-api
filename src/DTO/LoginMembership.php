<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the LoginMembership schema.
 */
class LoginMembership extends AbstractDto
{
    public ?string $memberId = null;

    public ?string $orgId = null;

    public ?string $orgName = null;

    public ?bool $isMasterOrg = null;

    /** @var array<int, \GoSuccess\Enhance\Enum\Role> */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\Role::class)]
    public ?array $roles = null;

    public ?float $siteAccessCount = null;
}
