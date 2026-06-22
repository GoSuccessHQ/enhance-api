<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Authoritative Name Server
 */
class AuthNs extends AbstractDto
{
    /** Server IP address */
    public ?string $ip = null;

    /**
     * list of resolved ip addresses for the domain
     * @var string[]
     */
    #[ArrayItemType('string')]
    public ?array $domainIps = null;

    /**
     * Tree of delegated AuthNs servers
     * @var array<string, mixed>
     */
    public ?array $delegations = null;
}
