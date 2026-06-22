<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * HTTP request methods used by the Enhance API.
 */
enum HttpMethod: string
{
    case GET = 'GET';

    case POST = 'POST';

    case PUT = 'PUT';

    case PATCH = 'PATCH';

    case DELETE = 'DELETE';
}
