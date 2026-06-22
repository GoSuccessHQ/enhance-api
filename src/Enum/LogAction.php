<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The LogAction enumeration.
 */
enum LogAction: string
{
    case Create = 'create';

    case Update = 'update';

    case Delete = 'delete';
}
