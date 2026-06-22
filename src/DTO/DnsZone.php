<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DnsZone schema.
 */
class DnsZone extends AbstractDto
{
    public ?string $origin = null;

    public ?DnsSoa $soa = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\DnsRecord> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\DnsRecord::class)]
    public ?array $records = null;

    public ?string $dnssecDsRecords = null;

    public ?string $dnssecDnskeyRecords = null;
}
