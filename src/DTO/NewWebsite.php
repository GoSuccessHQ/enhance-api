<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\PhpVersion;

/**
 * DTO for the NewWebsite schema.
 */
class NewWebsite extends AbstractDto
{
    /** The domain of the new website. */
    public ?string $domain = null;

    public ?int $subscriptionId = null;

    public ?string $appServerId = null;

    public ?string $backupServerId = null;

    public ?string $dbServerId = null;

    public ?string $emailServerId = null;

    public ?string $postgresqlServerId = null;

    public ?string $serverGroupId = null;

    public ?PhpVersion $phpVersion = null;

    public ?AdminCredentials $wordPressAdminCredentials = null;
}
