<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CPLocale;
use GoSuccess\Enhance\Enum\Status;

/**
 * DTO for the OrgUpdate schema.
 */
class OrgUpdate extends AbstractDto
{
    public ?string $name = null;

    public ?Status $status = null;

    public ?bool $isSuspended = null;

    public ?CPLocale $locale = null;

    public mixed $slackNotificationWebhookUrl = null;
}
