<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\MySQLAuthPlugin;

/**
 * DTO for the MySQLUser schema.
 */
class MySQLUser extends AbstractDto
{
    public ?string $dbId = null;

    public ?string $username = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $accessHosts = null;

    public ?MySQLAuthPlugin $authPlugin = null;

    /**
     * Table names mapped to a list of privileges on that table. The wildcard "*" means the privileges are granted for all tables.
     * @var array<string, mixed>
     */
    public ?array $grants = null;

    public ?string $createdAt = null;

    public ?bool $isEphemeral = null;
}
