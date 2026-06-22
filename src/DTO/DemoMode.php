<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Demo mode is a special mode that allows users to try out the application without having to sign up.
 */
class DemoMode extends AbstractDto
{
    public ?bool $status = null;
}
