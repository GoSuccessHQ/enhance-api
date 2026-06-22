<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewWpUser schema.
 */
class NewWpUser extends AbstractDto
{
    public ?string $login = null;

    public ?string $name = null;

    public ?string $password = null;

    public ?string $email = null;
}
