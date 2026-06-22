<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewSshKeyId schema.
 */
class NewSshKeyId extends AbstractDto
{
    /** The unique ID of the SSH key within the same authorized_keys file. */
    public ?string $id = null;
}
