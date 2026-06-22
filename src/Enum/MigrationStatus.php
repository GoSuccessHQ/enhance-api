<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The MigrationStatus enumeration.
 */
enum MigrationStatus: string
{
    case Queued = 'queued';

    case InProgress = 'inProgress';

    case Failed = 'failed';

    case Complete = 'complete';
}
