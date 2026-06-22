<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WebserverKind;

/**
 * DTO for the SetWebserverKind schema.
 */
class SetWebserverKind extends AbstractDto
{
    public ?WebserverKind $webserverKind = null;

    public ?string $serial = null;
}
