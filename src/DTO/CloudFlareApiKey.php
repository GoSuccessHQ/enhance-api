<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the CloudFlareApiKey schema.
 */
class CloudFlareApiKey extends AbstractDto
{
    public ?string $id = null;

    public ?string $token = null;

    public ?\DateTimeImmutable $updatedAt = null;

    public ?string $friendlyName = null;

    public ?\DateTimeImmutable $lastSync = null;

    public ?string $lastMessage = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $domains = null;
}
