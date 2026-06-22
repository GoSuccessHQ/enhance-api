<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The Recursion enumeration.
 */
enum Recursion: string
{
    case DirectCustomers = 'directCustomers';

    case Infinite = 'infinite';
}
