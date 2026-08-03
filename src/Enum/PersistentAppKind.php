<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The PersistentAppKind enumeration.
 */
enum PersistentAppKind: string
{
    case Generic = 'generic';

    case Openclaw = 'openclaw';
}
