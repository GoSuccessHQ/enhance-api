<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CloudFlareStatus;

/**
 * DTO for the Domain schema.
 */
class Domain extends AbstractDto
{
    public ?string $id = null;

    public ?string $orgId = null;

    public ?string $domain = null;

    public ?bool $dkim = null;

    public ?bool $spf = null;

    public ?CloudFlareStatus $cloudflareStatus = null;

    public ?string $cloudflareTokenFriendlyName = null;
}
