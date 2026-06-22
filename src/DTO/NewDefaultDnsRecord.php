<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\DnsRecordKind;

/**
 * DTO for the NewDefaultDnsRecord schema.
 */
class NewDefaultDnsRecord extends AbstractDto
{
    public ?DnsRecordKind $kind = null;

    public ?string $name = null;

    public ?string $value = null;

    public ?int $ttl = null;

    public ?bool $overrideConflicting = null;
}
