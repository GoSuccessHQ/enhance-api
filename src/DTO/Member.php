<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the Member schema.
 */
class Member extends AbstractDto
{
    public ?string $id = null;

    public ?string $loginId = null;

    public ?bool $isActive = null;

    public ?string $email = null;

    public ?string $name = null;

    /** @var array<int, \GoSuccess\Enhance\Enum\Role> */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\Role::class)]
    public ?array $roles = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $siteAccesses = null;

    /**
     * The notifications configured for this member.
     * @var string[]
     */
    #[ArrayItemType('string')]
    public ?array $notifications = null;

    public ?\DateTimeImmutable $joinedAt = null;

    public ?string $avatarPath = null;

    public ?string $colorCode = null;

    public ?string $authMethod = null;
}
