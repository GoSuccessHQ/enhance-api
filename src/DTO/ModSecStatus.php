<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ModSecStatus schema.
 */
class ModSecStatus extends AbstractDto
{
    public ?bool $enabled = null;
}
