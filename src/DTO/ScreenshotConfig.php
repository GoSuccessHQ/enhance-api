<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ScreenshotConfig schema.
 */
class ScreenshotConfig extends AbstractDto
{
    public ?bool $isEnabled = null;

    public ?int $interval = null;
}
