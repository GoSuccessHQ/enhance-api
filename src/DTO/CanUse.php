<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\MysqlKind;

/**
 * DTO for the CanUse schema.
 */
class CanUse extends AbstractDto
{
    public ?bool $ftp = null;

    public ?bool $fileManager = null;

    /** @var array<int, \GoSuccess\Enhance\Enum\PhpVersion> */
    #[ArrayItemType('enum', \GoSuccess\Enhance\Enum\PhpVersion::class)]
    public ?array $phpVersions = null;

    public ?bool $redis = null;

    public ?bool $modSec = null;

    public ?bool $backup = null;

    public ?MysqlKind $mysqlKind = null;

    public ?bool $persistentApps = null;

    public ?bool $roundcubeSso = null;

    public ?bool $postgresql = null;
}
