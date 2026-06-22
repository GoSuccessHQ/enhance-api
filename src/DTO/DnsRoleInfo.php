<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRoleState;

/**
 * DTO for the DnsRoleInfo schema.
 */
class DnsRoleInfo extends AbstractDto
{
    public ?ServerRoleState $state = null;

    public ?int $usage = null;

    public ?int $zonesCount = null;

    public ?ServiceInfo $dnscd = null;

    /** The number of websites whose DNS zones are assigned to be on this dns role. */
    public ?int $websitesCount = null;
}
