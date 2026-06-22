<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The PlanType enumeration.
 */
enum PlanType: string
{
    case Shared = 'shared';

    case Dedicated = 'dedicated';
}
