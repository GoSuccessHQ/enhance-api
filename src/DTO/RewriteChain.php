<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the RewriteChain schema.
 */
class RewriteChain extends AbstractDto
{
    public ?float $lineNumber = null;

    /** @var array<string, mixed> */
    public ?array $rule = null;

    /** @var array<int, mixed> */
    public ?array $conds = null;
}
