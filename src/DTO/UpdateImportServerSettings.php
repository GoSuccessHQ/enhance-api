<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerMigrationSettingsAuthType;

/**
 * DTO for the UpdateImportServerSettings schema.
 */
class UpdateImportServerSettings extends AbstractDto
{
    public ?string $hostname = null;

    public ?string $friendlyName = null;

    public ?string $sshUser = null;

    public ?string $sshPublicKey = null;

    public ?string $sshPrivateKey = null;

    public ?ServerMigrationSettingsAuthType $authKind = null;

    public ?string $authUser = null;

    public ?float $sshPort = null;

    public ?float $apiPort = null;

    public ?bool $allowPartialSync = null;

    public ?bool $asUserRoot = null;
}
