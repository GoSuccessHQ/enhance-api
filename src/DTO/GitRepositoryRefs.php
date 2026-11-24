<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the GitRepositoryRefs schema.
 */
class GitRepositoryRefs extends AbstractDto
{
    /** @var array<int, string> */
    #[ArrayItemType('string')]
    public ?array $branches = null;

    /** @var array<int, string> */
    #[ArrayItemType('string')]
    public ?array $tags = null;
}
