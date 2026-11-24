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

    case Nodejs = 'nodejs';

    case Django = 'django';

    case Tomcat = 'tomcat';

    case Laravel = 'laravel';

    case Php = 'php';

    case N8n = 'n8n';
}
