<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ActivityDomainEntity schema.
 */
class ActivityDomainEntity extends AbstractDto
{
    public ?string $type = null;

    /** @var array<string, mixed> */
    public ?array $content = null;
}
