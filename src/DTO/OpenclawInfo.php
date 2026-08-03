<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the OpenclawInfo schema.
 */
class OpenclawInfo extends AbstractDto
{
    /** Access token for the Openclaw installation */
    public ?string $token = null;

    /** If disabled, a user can access Openclaw from any device with only the access token. */
    public ?bool $device_auth_enabled = null;
}
