<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WpUser schema.
 */
class WpUser extends AbstractDto
{
    public ?int $id = null;

    public ?string $login = null;

    public ?string $email = null;
}
