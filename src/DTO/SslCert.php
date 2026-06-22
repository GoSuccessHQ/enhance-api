<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SslCert schema.
 */
class SslCert extends AbstractDto
{
    public ?string $cert = null;

    public ?string $key = null;
}
