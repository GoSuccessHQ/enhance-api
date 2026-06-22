<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ActivityWebsiteEntityDetail schema.
 */
class ActivityWebsiteEntityDetail extends AbstractDto
{
    public ?string $domain = null;

    public ?string $subscriptionId = null;

    public ?string $orgId = null;
}
