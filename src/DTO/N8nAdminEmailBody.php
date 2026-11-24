<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the N8nAdminEmailBody schema.
 */
class N8nAdminEmailBody extends AbstractDto
{
    /** The instance owner's new email, validated like the email of N8nAdminCredentialsBody. */
    public ?string $adminEmail = null;
}
