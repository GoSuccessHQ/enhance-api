<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the FtpUsersFullListing schema.
 */
class FtpUsersFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\FtpUser> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\FtpUser::class)]
    public ?array $items = null;
}
