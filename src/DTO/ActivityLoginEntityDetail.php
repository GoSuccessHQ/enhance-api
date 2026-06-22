<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ActivityLoginEntityDetail schema.
 */
class ActivityLoginEntityDetail extends AbstractDto
{
    public ?string $name = null;

    public ?string $email = null;

    public ?string $realmId = null;
}
