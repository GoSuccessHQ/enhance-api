<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\Role;

/**
 * DTO for the InviteValidation schema.
 */
class InviteValidation extends AbstractDto
{
    public ?bool $isValid = null;

    public ?string $loginId = null;

    public ?string $orgId = null;

    public ?string $orgName = null;

    public ?Role $role = null;
}
