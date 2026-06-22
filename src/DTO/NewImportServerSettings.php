<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ImportKind;
use GoSuccess\Enhance\Enum\ServerMigrationSettingsAuthType;

/**
 * DTO for the NewImportServerSettings schema.
 */
class NewImportServerSettings extends AbstractDto
{
    public ?string $sshPrivateKey = null;

    public ?string $sshPublicKey = null;

    public ?bool $allowPartialSync = null;

    public ?bool $asUserRoot = null;

    public ?string $hostname = null;

    public ?string $friendlyName = null;

    public ?string $sshUser = null;

    public ?ImportKind $importType = null;

    public ?ServerMigrationSettingsAuthType $authKind = null;

    public ?string $authUser = null;

    public ?string $authPass = null;

    public ?float $sshPort = null;

    public ?float $apiPort = null;
}
