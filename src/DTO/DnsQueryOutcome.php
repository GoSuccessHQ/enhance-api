<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Detailed DNS query outcome, walking from root DNS to all the way back to IP addresses for a domain
 */
class DnsQueryOutcome extends AbstractDto
{
    /** Fully qualified domain name */
    public ?string $fqdn = null;

    /** name and IP of the root server that was queried */
    public mixed $root = null;

    /**
     * Tree of top level domain name servers
     * @var array<string, mixed>
     */
    public ?array $tldNsMap = null;
}
