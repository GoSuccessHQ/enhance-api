<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the OrgOwnerUpdate schema.
 */
class OrgOwnerUpdate extends AbstractDto
{
    public ?string $memberId = null;
}
