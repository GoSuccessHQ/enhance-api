<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the N8nAdminCredentials schema.
 */
class N8nAdminCredentials extends AbstractDto
{
    /** The email n8n shows as the instance owner. The password is never returned. */
    public ?string $adminEmail = null;
}
