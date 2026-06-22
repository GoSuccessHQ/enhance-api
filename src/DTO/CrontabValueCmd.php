<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the CrontabValueCmd schema.
 */
class CrontabValueCmd extends AbstractDto
{
    /** @var array<string, mixed> */
    public ?array $cronCmd = null;
}
