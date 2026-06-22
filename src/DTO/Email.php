<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\EmailStatus;

/**
 * DTO for the Email schema.
 */
class Email extends AbstractDto
{
    public ?string $websiteId = null;

    public ?string $mailboxName = null;

    public ?string $address = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $aliases = null;

    public ?bool $hasMailbox = null;

    public ?EmailStatus $status = null;

    public ?Quota $quota = null;

    public ?int $forwardersCount = null;

    public ?string $createdAt = null;

    public ?bool $isCatchAll = null;

    public ?bool $ssoAvailable = null;
}
