<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\EmailStatus;

/**
 * DTO for the UpdateEmail schema.
 */
class UpdateEmail extends AbstractDto
{
    public ?string $mailboxName = null;

    public ?string $mailboxPassword = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $aliases = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $forwarders = null;

    public ?bool $hasMailbox = null;

    public ?EmailStatus $status = null;

    public ?int $quota = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $blacklist = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $whitelist = null;

    public ?bool $isCatchAll = null;
}
