<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewServerGroup schema.
 */
class NewServerGroup extends AbstractDto
{
    public ?string $name = null;
}
