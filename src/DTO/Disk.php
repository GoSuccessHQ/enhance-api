<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Disk schema.
 */
class Disk extends AbstractDto
{
    public ?string $name = null;

    public ?string $mountPoint = null;

    public ?string $fileSystem = null;

    public ?SpaceUsage $usage = null;

    public ?string $kind = null;
}
