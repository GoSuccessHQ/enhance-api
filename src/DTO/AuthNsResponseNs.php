<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the AuthNsResponseNs schema.
 */
class AuthNsResponseNs extends AbstractDto
{
    public ?string $name = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $ips = null;
}
