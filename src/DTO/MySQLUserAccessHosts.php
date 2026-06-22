<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the MySQLUserAccessHosts schema.
 */
class MySQLUserAccessHosts extends AbstractDto
{
    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $accessHosts = null;
}
