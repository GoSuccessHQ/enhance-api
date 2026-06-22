<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the EmailAuth schema.
 */
class EmailAuth extends AbstractDto
{
    public ?bool $dkim = null;

    public ?string $dkimPublicKey = null;
}
