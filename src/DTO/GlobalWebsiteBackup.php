<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the GlobalWebsiteBackup schema.
 */
class GlobalWebsiteBackup extends AbstractDto
{
    public ?string $websiteId = null;

    public ?string $primaryDomain = null;

    public ?int $snapshotId = null;

    public ?int $emailsCount = null;

    public ?int $filesSize = null;

    public ?int $mysqlDbsCount = null;

    public ?\DateTimeImmutable $createdAt = null;

    public ?string $serverId = null;

    public ?Customer $customer = null;
}
