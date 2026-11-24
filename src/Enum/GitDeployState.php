<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The GitDeployState enumeration.
 */
enum GitDeployState: string
{
    case Pending = 'pending';

    case Running = 'running';

    case Complete = 'complete';

    case Failed = 'failed';
}
