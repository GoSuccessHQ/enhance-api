<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the N8nAdminPasswordBody schema.
 */
class N8nAdminPasswordBody extends AbstractDto
{
    /** The instance owner's new password, 8 to 72 characters. It is hashed before it is stored and never returned. */
    public ?string $adminPassword = null;
}
