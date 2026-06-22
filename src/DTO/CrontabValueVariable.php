<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the CrontabValueVariable schema.
 */
class CrontabValueVariable extends AbstractDto
{
    /** @var array<string, mixed> */
    public ?array $variable = null;
}
