<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the OrgGitHubApp schema.
 */
class OrgGitHubApp extends AbstractDto
{
    public ?string $slug = null;

    /** @var array<string, mixed> */
    public ?array $owner = null;

    public ?string $created_at = null;
}
