<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * A username/password for a web app such as WordPress
 */
class AdminCredentials extends AbstractDto
{
    public ?string $username = null;

    public ?string $password = null;

    public ?string $email = null;
}
