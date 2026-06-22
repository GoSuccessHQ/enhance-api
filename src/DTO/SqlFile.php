<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SqlFile schema.
 */
class SqlFile extends AbstractDto
{
    /** Upload either a raw sql file (must be utf8 valid string) or .zip or .gz file with the sql string. */
    public ?string $sql = null;
}
