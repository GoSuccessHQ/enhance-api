<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewEmail schema.
 */
class NewEmail extends AbstractDto
{
    public ?string $mailboxName = null;

    public ?string $mailboxPassword = null;

    public ?string $username = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $aliases = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $forwarders = null;

    public ?int $quota = null;

    public ?bool $isCatchAll = null;
}
