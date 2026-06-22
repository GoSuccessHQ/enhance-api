<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DnsThirdPartyProvider schema.
 */
class DnsThirdPartyProvider extends AbstractDto
{
    public ?int $id = null;

    public ?string $url = null;

    /** @var array<string, mixed> */
    public ?array $headers = null;
}
