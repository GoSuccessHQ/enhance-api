<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the AuthNsResponse schema.
 */
class AuthNsResponse extends AbstractDto
{
    public ?bool $matchesPlatform = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\AuthNsResponseNs> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\AuthNsResponseNs::class)]
    public ?array $authNs = null;
}
