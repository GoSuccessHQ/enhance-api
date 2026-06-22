<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewPostgresqlUser schema.
 */
class NewPostgresqlUser extends AbstractDto
{
    public ?string $username = null;

    public ?string $password = null;
}
