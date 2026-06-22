<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SpamThresholds schema.
 */
class SpamThresholds extends AbstractDto
{
    public ?float $greylist = null;

    public ?float $reject = null;

    public ?float $spambox = null;
}
