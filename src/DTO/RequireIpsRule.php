<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\RequireIpsRuleKind;

/**
 * DTO for the RequireIpsRule schema.
 */
class RequireIpsRule extends AbstractDto
{
    public ?RequireIpsRuleKind $kind = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $ips = null;
}
