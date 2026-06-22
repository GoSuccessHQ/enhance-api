<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the OutboundSpamScanningSettings schema.
 */
class OutboundSpamScanningSettings extends AbstractDto
{
    public ?bool $enabled = null;
}
