<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UpdateBackupRemoteStorageS3 schema.
 */
class UpdateBackupRemoteStorageS3 extends AbstractDto
{
    public ?string $region = null;

    public ?string $endpoint = null;

    public ?string $bucket = null;

    public ?string $accessKeyId = null;

    public ?string $accessKeySecret = null;
}
