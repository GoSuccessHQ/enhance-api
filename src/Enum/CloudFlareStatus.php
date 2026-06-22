<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The CloudFlareStatus enumeration.
 */
enum CloudFlareStatus: string
{
    case Connected = 'Connected';

    case Disconnected = 'Disconnected';

    case Error = 'Error';
}
