<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The DomainMappingKind enumeration.
 */
enum DomainMappingKind: string
{
    case Primary = 'primary';

    case Preview = 'preview';

    case Addon = 'addon';

    case Alias = 'alias';

    case Subdomain = 'subdomain';
}
