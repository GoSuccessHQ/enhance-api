<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The RequireIpsRuleKind enumeration.
 */
enum RequireIpsRuleKind: string
{
    case Allow = 'allow';

    case Block = 'block';
}
