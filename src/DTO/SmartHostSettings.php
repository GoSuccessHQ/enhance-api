<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SmartHostSettings schema.
 */
class SmartHostSettings extends AbstractDto
{
    /** @var array<string, mixed> */
    public ?array $host = null;

    /** @var array<string, mixed> */
    public ?array $creds = null;
}
