<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the NewAccessTokenResponse schema.
 */
class NewAccessTokenResponse extends AbstractDto
{
    public ?string $id = null;

    public ?string $firstFive = null;

    public ?string $unencryptedToken = null;
}
