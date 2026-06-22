<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ScreenshotConfigUpdate schema.
 */
class ScreenshotConfigUpdate extends AbstractDto
{
    public ?bool $enable = null;

    public ?int $interval = null;
}
