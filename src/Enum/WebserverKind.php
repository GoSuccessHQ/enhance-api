<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The WebserverKind enumeration.
 */
enum WebserverKind: string
{
    case LiteSpeed = 'liteSpeed';

    case OpenLiteSpeed = 'openLiteSpeed';

    case DummyWebServer = 'dummyWebServer';

    case Apache = 'apache';

    case Nginx = 'nginx';
}
