<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the TagsFullListing schema.
 */
class TagsFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\Tag> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Tag::class)]
    public ?array $items = null;
}
