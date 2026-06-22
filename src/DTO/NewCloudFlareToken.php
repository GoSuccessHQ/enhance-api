<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewCloudFlareToken schema.
 */
class NewCloudFlareToken extends AbstractDto
{
    public mixed $token = null;

    public mixed $friendlyName = null;
}
