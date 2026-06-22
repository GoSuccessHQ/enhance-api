<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the CgroupLimits schema.
 */
class CgroupLimits extends AbstractDto
{
    public ?float $nproc = null;

    public ?float $memoryLimit = null;

    public ?float $iops = null;

    public ?float $ioBandwidth = null;

    public ?float $virtualCpus = null;

    public ?float $swapLimit = null;
}
