<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * If the `rule` property is missing, we will delete a rule on the given line number instead. If just the `conds` property is missing, it defauls to an empty array.
 */
class UpdateRewriteChain extends AbstractDto
{
    public ?float $lineNumber = null;

    /** @var array<string, mixed> */
    public ?array $rule = null;

    /** @var array<int, mixed> */
    public ?array $conds = null;
}
