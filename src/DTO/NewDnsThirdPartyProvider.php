<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewDnsThirdPartyProvider schema.
 */
class NewDnsThirdPartyProvider extends AbstractDto
{
    public ?string $url = null;

    /** @var array<string, mixed> */
    public ?array $headers = null;
}
