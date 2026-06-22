<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CPLocale;

/**
 * DTO for the Install schema.
 */
class Install extends AbstractDto
{
    public ?LoginInfo $owner = null;

    public ?string $orgName = null;

    public ?bool $acceptTerms = null;

    public ?CPLocale $locale = null;
}
