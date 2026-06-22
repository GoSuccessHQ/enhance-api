<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\DaemonKind;
use GoSuccess\Enhance\Enum\ServiceLogStatus;

/**
 * DTO for the ServiceLog schema.
 */
class ServiceLog extends AbstractDto
{
    public ?\DateTimeImmutable $createdAt = null;

    public ?DaemonKind $serviceKind = null;

    public ?ServiceLogStatus $status = null;

    public mixed $metadata = null;
}
