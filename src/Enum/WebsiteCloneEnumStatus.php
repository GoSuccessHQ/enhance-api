<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The WebsiteCloneEnumStatus enumeration.
 */
enum WebsiteCloneEnumStatus: string
{
    case Queued = 'queued';

    case InProgress = 'inProgress';

    case Failed = 'failed';

    case Complete = 'complete';
}
