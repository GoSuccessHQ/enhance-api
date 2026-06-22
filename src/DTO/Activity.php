<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ActivityKind;

/**
 * DTO for the Activity schema.
 */
class Activity extends AbstractDto
{
    public ?string $id = null;

    public ?string $orgId = null;

    public ?ActivityKind $kind = null;

    public ?\DateTimeImmutable $createdAt = null;

    public ?string $message = null;

    public ?ActivityContext $context = null;

    /** @var array<string, mixed> */
    public ?array $activityObject = null;
}
