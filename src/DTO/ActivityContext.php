<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ActivityContext schema.
 */
class ActivityContext extends AbstractDto
{
    public ?ActivityOrgEntity $org = null;

    public ?ActivityWebsiteEntity $website = null;

    public ?ActivityDomainEntity $domain = null;

    public mixed $actor = null;

    public ?ActivityServerEntity $server = null;

    public ?ActivityErrorEntity $error = null;
}
