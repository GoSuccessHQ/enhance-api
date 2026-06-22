<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the TransferUserAccountReqBody schema.
 */
class TransferUserAccountReqBody extends AbstractDto
{
    public ?int $subscriptionId = null;

    public ?bool $asUserRoot = null;

    public ?bool $allowPartialSync = null;

    public ?string $appServerId = null;

    public ?string $backupServerId = null;

    public ?string $dbServerId = null;

    public ?string $emailServerId = null;
}
