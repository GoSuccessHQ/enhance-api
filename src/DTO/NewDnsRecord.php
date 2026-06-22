<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\DnsRecordKind;

/**
 * DTO for the NewDnsRecord schema.
 */
class NewDnsRecord extends AbstractDto
{
    public ?DnsRecordKind $kind = null;

    public ?string $name = null;

    public ?string $value = null;

    public ?int $ttl = null;

    public ?bool $proxy = null;
}
