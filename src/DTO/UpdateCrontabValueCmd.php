<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UpdateCrontabValueCmd schema.
 */
class UpdateCrontabValueCmd extends AbstractDto
{
    /** @var array<string, mixed> */
    public ?array $cronCmd = null;
}
