<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SshKeyFullListing schema.
 */
class SshKeyFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\SshKey> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\SshKey::class)]
    public ?array $items = null;
}
