<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the N8nAdminCredentialsBody schema.
 */
class N8nAdminCredentialsBody extends AbstractDto
{
    /** The instance owner's email: letters, digits, the `._%+-` local-part punctuation and a plain hostname. */
    public ?string $adminEmail = null;

    /** The instance owner's new password, 8 to 72 characters. It is hashed before it is stored and never returned. */
    public ?string $adminPassword = null;
}
