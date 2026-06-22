<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SiteAccessMember schema.
 */
class SiteAccessMember extends AbstractDto
{
    public ?string $id = null;

    public ?string $name = null;

    public ?string $email = null;

    public ?string $avatarPath = null;

    public ?string $colorCode = null;
}
