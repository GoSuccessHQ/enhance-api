<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Autoresponder schema.
 */
class Autoresponder extends AbstractDto
{
    public ?int $id = null;

    public ?\DateTimeImmutable $startDate = null;

    public ?\DateTimeImmutable $endDate = null;

    public ?bool $enabled = null;

    public ?string $subject = null;

    public ?string $body = null;
}
