<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WebsiteStatus;

/**
 * DTO for the EmailDetailed schema.
 */
class EmailDetailed extends AbstractDto
{
    public ?string $mailboxName = null;

    public ?string $address = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $aliases = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $forwarders = null;

    public ?bool $hasMailbox = null;

    public ?WebsiteStatus $status = null;

    public ?Quota $quota = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $blacklist = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $whitelist = null;

    public ?int $autorespondersCount = null;

    public ?string $createdAt = null;

    public ?bool $isCatchAll = null;
}
