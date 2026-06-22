<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Customer schema.
 */
class Customer extends AbstractDto
{
    public ?string $id = null;

    public ?string $name = null;
}
