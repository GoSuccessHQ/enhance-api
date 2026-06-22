<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the LetsEncryptPreflightResult schema.
 */
class LetsEncryptPreflightResult extends AbstractDto
{
    public ?bool $canIssue = null;

    public ?string $error = null;
}
