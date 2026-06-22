<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\WebsiteStatus;

/**
 * DTO for the UpdateWebsite schema.
 */
class UpdateWebsite extends AbstractDto
{
    /** The PHP version. */
    public ?PhpVersion $phpVersion = null;

    public ?WebsiteStatus $status = null;

    public ?bool $isSuspended = null;

    /** @var int[] */
    #[ArrayItemType('int')]
    public ?array $tags = null;

    /** The website can be moved to another subscription within the organization by setting this field. */
    public mixed $subscriptionId = null;

    public ?string $orgId = null;
}
