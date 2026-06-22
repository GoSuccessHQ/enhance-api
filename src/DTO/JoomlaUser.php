<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the JoomlaUser schema.
 */
class JoomlaUser extends AbstractDto
{
    public ?int $id = null;

    public ?string $username = null;

    public ?string $name = null;

    public ?string $email = null;

    public ?bool $blocked = null;

    public ?bool $super_user = null;
}
