<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * The service has returned a payload we didn't expect. There's a chance of different service running at the standard port.
 */
class LogGreetingsMessageMetadata extends AbstractDto
{
    /** This is a list of bytes which have been returned by the service. For example "[50,50,48,32]". */
    public ?string $greetingsMessage = null;
}
