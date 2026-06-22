<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WebsiteAppKind;

/**
 * DTO for the InstallableWebsiteApp schema.
 */
class InstallableWebsiteApp extends AbstractDto
{
    public ?WebsiteAppKind $app = null;

    public ?string $version = null;

    public ?bool $isLatest = null;

    public ?string $description = null;

    /** Approximate number of bytes after fresh installation. */
    public ?float $size = null;

    public ?\DateTimeImmutable $createdAt = null;
}
