<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CPLocale;

/**
 * DTO for the AcceptInviteBody schema.
 */
class AcceptInviteBody extends AbstractDto
{
    public ?string $email = null;

    public ?string $password = null;

    public ?CPLocale $locale = null;
}
