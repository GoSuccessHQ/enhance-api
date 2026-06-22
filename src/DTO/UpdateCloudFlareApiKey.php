<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UpdateCloudFlareApiKey schema.
 */
class UpdateCloudFlareApiKey extends AbstractDto
{
    public ?string $token = null;

    public ?string $friendlyName = null;
}
