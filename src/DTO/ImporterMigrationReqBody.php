<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ImporterMigrationReqBody schema.
 */
class ImporterMigrationReqBody extends AbstractDto
{
    public ?int $subscriptionId = null;

    public ?bool $forceQueue = null;

    public ?string $appServerId = null;

    public ?string $backupServerId = null;

    public ?string $dbServerId = null;

    public ?string $emailServerId = null;
}
