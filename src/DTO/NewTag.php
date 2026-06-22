<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewTag schema.
 */
class NewTag extends AbstractDto
{
    public ?string $tag = null;

    public ?string $colorCode = null;
}
