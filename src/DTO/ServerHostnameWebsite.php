<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerHostnameWebsite schema.
 */
class ServerHostnameWebsite extends AbstractDto
{
    public ?string $websiteId = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\DomainWithUuid> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\DomainWithUuid::class)]
    public ?array $domains = null;
}
