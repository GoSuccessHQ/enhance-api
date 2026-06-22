<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the PostgresqlUser schema.
 */
class PostgresqlUser extends AbstractDto
{
    public ?string $username = null;

    /**
     * A list of the databases this user has admin privileges on
     * @var string[]
     */
    #[ArrayItemType('string')]
    public ?array $privs = null;

    public ?string $createdAt = null;
}
