<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WebsiteLogStatus;

/**
 * DTO for the WebsiteLog schema.
 */
class WebsiteLog extends AbstractDto
{
    public ?\DateTimeImmutable $createdAt = null;

    public ?WebsiteLogStatus $status = null;

    public mixed $metadata = null;
}
