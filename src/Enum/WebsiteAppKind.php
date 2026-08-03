<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The WebsiteAppKind enumeration.
 */
enum WebsiteAppKind: string
{
    case Wordpress = 'wordpress';

    case Joomla = 'joomla';

    case Openclaw = 'openclaw';
}
