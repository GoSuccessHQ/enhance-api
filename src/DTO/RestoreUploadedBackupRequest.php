<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the RestoreUploadedBackupRequest schema.
 */
class RestoreUploadedBackupRequest extends AbstractDto
{
    /** The file name you would like to restore, from the website's home dir */
    public ?string $fileName = null;
}
