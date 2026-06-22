<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The status of the website at the time the log was written. Some statuses have additional metadata (ok, slow, unrecognizedGreetingsMessage)
 *     whereas some don't (timeout).
 */
enum ServiceLogStatus: string
{
    case Ok = 'ok';

    case Slow = 'slow';

    case Timeout = 'timeout';

    case UnrecognizedGreetingsMessage = 'unrecognizedGreetingsMessage';
}
