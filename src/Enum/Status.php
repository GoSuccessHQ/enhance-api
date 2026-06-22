<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The Status enumeration.
 */
enum Status: string
{
    case Active = 'active';

    case Deleted = 'deleted';
}
