<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SlaveRegistration schema.
 */
class SlaveRegistration extends AbstractDto
{
    public ?string $hostname = null;
}
