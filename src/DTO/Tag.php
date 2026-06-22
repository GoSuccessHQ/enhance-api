<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Tag schema.
 */
class Tag extends AbstractDto
{
    public ?int $id = null;

    public ?string $tag = null;

    public ?string $colorCode = null;
}
