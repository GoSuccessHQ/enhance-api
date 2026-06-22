<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the UpdateRewriteChainFullListing schema.
 */
class UpdateRewriteChainFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\UpdateRewriteChain> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\UpdateRewriteChain::class)]
    public ?array $items = null;
}
