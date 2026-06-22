<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CloudFlareStatus;
use GoSuccess\Enhance\Enum\DomainMappingKind;

/**
 * DTO for the WebsiteDomain schema.
 */
class WebsiteDomain extends AbstractDto
{
    public ?string $id = null;

    public ?string $domain = null;

    public ?string $documentRoot = null;

    public ?DomainMappingKind $kind = null;

    public ?CloudFlareStatus $cloudflareStatus = null;
}
