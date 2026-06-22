<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\WebsiteKind;

/**
 * DTO for the WebsiteCloneNewWebsite schema.
 */
class WebsiteCloneNewWebsite extends AbstractDto
{
    /** The domain of the new website. */
    public ?string $domain = null;

    public ?int $subscriptionId = null;

    public ?string $appServerId = null;

    public ?string $backupServerId = null;

    public ?string $dbServerId = null;

    public ?string $emailServerId = null;

    public ?string $serverGroupId = null;

    public ?PhpVersion $phpVersion = null;

    public ?WebsiteKind $kind = null;
}
