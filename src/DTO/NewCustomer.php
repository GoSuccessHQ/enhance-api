<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewCustomer schema.
 */
class NewCustomer extends AbstractDto
{
    public ?string $name = null;
}
