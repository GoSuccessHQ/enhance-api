<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UnsetType schema.
 */
class UnsetType extends AbstractDto
{
    public ?bool $unset = null;
}
