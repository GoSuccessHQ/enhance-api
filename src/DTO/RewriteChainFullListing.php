<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the RewriteChainFullListing schema.
 */
class RewriteChainFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\RewriteChain> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\RewriteChain::class)]
    public ?array $items = null;
}
