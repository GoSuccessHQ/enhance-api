<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * File system quota info in bytes.
 */
class FsQuotaInfo extends AbstractDto
{
    public ?float $totalAvailable = null;

    public ?float $used = null;

    public ?float $inodesAvailable = null;

    public ?float $inodesUsed = null;
}
