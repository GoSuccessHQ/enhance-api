<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The LogLevel enumeration.
 */
enum LogLevel: string
{
    case Info = 'info';

    case Error = 'error';
}
