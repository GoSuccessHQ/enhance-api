<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UpdateAccessToken schema.
 */
class UpdateAccessToken extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\Enum\Role> */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\Role::class)]
    public ?array $roles = null;

    public ?\DateTimeImmutable $tokenExpires = null;

    public ?string $friendlyName = null;

    /**
     * If this array is empty, all IPs are allowed
     * @var string[]
     */
    #[ArrayItemType('string')]
    public ?array $allowedIps = null;

    public ?bool $ipRestricted = null;
}
