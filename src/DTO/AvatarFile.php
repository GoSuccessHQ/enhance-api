<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the AvatarFile schema.
 */
class AvatarFile extends AbstractDto
{
    public ?string $avatar = null;
}
