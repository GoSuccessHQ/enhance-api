<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\RemoteStoragePurpose;

/**
 * DTO for the CreateBackupRemoteStorageS3 schema.
 */
class CreateBackupRemoteStorageS3 extends AbstractDto
{
    public ?RemoteStoragePurpose $purpose = null;

    public ?string $region = null;

    public ?string $endpoint = null;

    public ?string $bucket = null;

    public ?string $accessKeyId = null;

    public ?string $accessKeySecret = null;

    public ?string $prefix = null;
}
