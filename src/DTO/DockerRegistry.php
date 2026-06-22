<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DockerRegistry schema.
 */
class DockerRegistry extends AbstractDto
{
    public ?string $url = null;

    public ?string $user = null;

    public ?string $password = null;
}
