<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The Outcome enumeration.
 */
enum Outcome: string
{
    case Success = 'success';

    case RestartRequired = 'restartRequired';

    case UpdateNotApplied = 'updateNotApplied';
}
