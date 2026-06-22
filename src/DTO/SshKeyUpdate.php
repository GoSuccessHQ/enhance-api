<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SshKeyUpdate schema.
 */
class SshKeyUpdate extends AbstractDto
{
    /** The SSH key in PEM format. */
    public ?string $value = null;

    /** The friendly name associated with the key. */
    public ?string $name = null;
}
