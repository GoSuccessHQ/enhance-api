<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the OpenclawDevice schema.
 */
class OpenclawDevice extends AbstractDto
{
    public ?string $requestId = null;

    public ?string $id = null;

    public ?string $platform = null;

    public ?string $clientMode = null;

    public ?string $clientId = null;
}
