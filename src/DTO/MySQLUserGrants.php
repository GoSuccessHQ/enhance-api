<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MySQLUserGrants schema.
 */
class MySQLUserGrants extends AbstractDto
{
    public ?string $dbName = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $grants = null;
}
