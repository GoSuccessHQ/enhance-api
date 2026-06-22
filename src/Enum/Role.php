<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The role of the member in the organization.
 */
enum Role: string
{
    case Owner = 'Owner';

    case SuperAdmin = 'SuperAdmin';

    case Business = 'Business';

    case SiteAccess = 'SiteAccess';

    case Support = 'Support';

    case Sysadmin = 'Sysadmin';
}
