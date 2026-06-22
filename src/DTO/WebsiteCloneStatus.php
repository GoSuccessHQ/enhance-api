<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CloneStatus;

/**
 * DTO for the WebsiteCloneStatus schema.
 */
class WebsiteCloneStatus extends AbstractDto
{
    public ?CloneStatus $status = null;
}
