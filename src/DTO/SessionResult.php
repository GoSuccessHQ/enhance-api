<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SessionResult schema.
 */
class SessionResult extends AbstractDto
{
    public ?string $authMethod = null;
}
