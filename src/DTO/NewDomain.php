<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewDomain schema.
 */
class NewDomain extends AbstractDto
{
    public ?string $domain = null;
}
