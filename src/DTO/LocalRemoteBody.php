<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\LocalRemote;

/**
 * Whether a domain is treated as local or remote by the MTA
 */
class LocalRemoteBody extends AbstractDto
{
    public ?LocalRemote $localRemote = null;
}
