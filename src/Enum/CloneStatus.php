<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The CloneStatus enumeration.
 */
enum CloneStatus: string
{
    case CloningWebsite = 'cloningWebsite';

    case CloningDatabases = 'cloningDatabases';

    case CloningHomeDir = 'cloningHomeDir';

    case Succeeded = 'succeeded';

    case Failed = 'failed';
}
