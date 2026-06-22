<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\DnsRecordKind;

/**
 * DTO for the DnsRecord schema.
 */
class DnsRecord extends AbstractDto
{
    public ?string $id = null;

    public ?DnsRecordKind $kind = null;

    public ?string $name = null;

    public ?string $value = null;

    /** In seconds */
    public ?int $ttl = null;

    /** Is CloudFlare proxy on? */
    public ?bool $proxy = null;
}
