<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * Limit the log level of a service.
 */
enum LogLevelLimit: string
{
    case Error = 'error';

    case Warn = 'warn';

    case Info = 'info';

    case Trace = 'trace';

    case Debug = 'debug';
}
