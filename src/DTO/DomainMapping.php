<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CloudFlareStatus;
use GoSuccess\Enhance\Enum\DomainMappingKind;

/**
 * DTO for the DomainMapping schema.
 */
class DomainMapping extends AbstractDto
{
    public ?string $domainId = null;

    public ?string $websiteId = null;

    public ?string $domain = null;

    public ?DomainMappingKind $mappingKind = null;

    public ?string $documentRoot = null;

    public ?DomainSslCert $cert = null;

    public ?CloudFlareStatus $cloudflareStatus = null;

    public ?string $cloudflareFriendlyName = null;

    public ?string $cloudflareTokenId = null;
}
