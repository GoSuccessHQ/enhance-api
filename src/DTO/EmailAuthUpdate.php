<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the EmailAuthUpdate schema.
 */
class EmailAuthUpdate extends AbstractDto
{
    public ?bool $dkim = null;
}
