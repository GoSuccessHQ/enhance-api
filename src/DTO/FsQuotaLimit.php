<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * File system quota settings in bytes.
 */
class FsQuotaLimit extends AbstractDto
{
    public ?float $totalAvailable = null;

    public ?float $inodesAvailable = null;
}
