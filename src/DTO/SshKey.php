<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SshKey schema.
 */
class SshKey extends AbstractDto
{
    /** The unique ID of the SSH key within the same authorized_keys file. */
    public ?string $id = null;

    /** The datetime of when this SSH key was created. */
    public ?\DateTimeImmutable $createdAt = null;

    /** The SSH key (without the comment). */
    public ?string $value = null;

    /** The friendly name associated with the key. */
    public ?string $name = null;
}
