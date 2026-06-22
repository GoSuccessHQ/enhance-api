<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The VhostWebserverKind enumeration.
 */
enum VhostWebserverKind: string
{
    case Apache = 'apache';

    case Nginx = 'nginx';
}
