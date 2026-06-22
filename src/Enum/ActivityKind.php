<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * Different activities that happen in orchd. There will be a lot of changes to the values of this enum as time goes by, consider this non-exhausive and be graceful with unknown values.
 */
enum ActivityKind: string
{
    case Added = 'added';

    case Removed = 'removed';

    case Cloned = 'cloned';

    case Imported = 'imported';

    case BackedUp = 'backedUp';

    case ErrorRaised = 'errorRaised';

    case BackupError = 'backupError';
}
