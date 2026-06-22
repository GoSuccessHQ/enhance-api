<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsiteCloneLogEntry schema.
 */
class WebsiteCloneLogEntry extends AbstractDto
{
    public ?\DateTimeImmutable $createdAt = null;

    public ?string $message = null;

    public ?float $percentageComplete = null;
}
