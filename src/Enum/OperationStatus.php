<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The OperationStatus enumeration.
 */
enum OperationStatus: string
{
    case Started = 'started';

    case Successful = 'successful';

    case Failed = 'failed';
}
