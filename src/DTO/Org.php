<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CPLocale;
use GoSuccess\Enhance\Enum\Status;

/**
 * DTO for the Org schema.
 */
class Org extends AbstractDto
{
    public ?string $id = null;

    public ?string $parentId = null;

    public ?string $name = null;

    public ?Status $status = null;

    public ?string $suspendedBy = null;

    public ?string $owner = null;

    public ?string $ownerEmail = null;

    public ?string $ownerId = null;

    public ?string $ownerLoginId = null;

    public ?int $subscriptionsCount = null;

    public ?int $websitesCount = null;

    public ?string $createdAt = null;

    public ?string $ownerAvatarPath = null;

    public ?CPLocale $locale = null;

    public ?string $slackNotificationWebhookUrl = null;
}
