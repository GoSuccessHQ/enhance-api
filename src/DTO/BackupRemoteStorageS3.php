<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\RemoteStoragePurpose;

/**
 * DTO for the BackupRemoteStorageS3 schema.
 */
class BackupRemoteStorageS3 extends AbstractDto
{
    public ?RemoteStoragePurpose $purpose = null;

    public ?string $region = null;

    public ?string $endpoint = null;

    public ?string $bucket = null;

    public ?string $accessKeyId = null;

    public ?string $prefix = null;
}
