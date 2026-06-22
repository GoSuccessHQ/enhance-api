<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the EmailsListing schema.
 */
class EmailsListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Email> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Email::class)]
    public ?array $items = null;

    public ?int $total = null;
}
