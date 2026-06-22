<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\DnsRecordKind;

/**
 * DTO for the UpdateDnsRecord schema.
 */
class UpdateDnsRecord extends AbstractDto
{
    public ?DnsRecordKind $kind = null;

    public ?string $name = null;

    public ?string $value = null;

    /** In seconds */
    public ?int $ttl = null;

    /** If CloudFlare enabled, will enable the proxy */
    public ?bool $proxy = null;
}
