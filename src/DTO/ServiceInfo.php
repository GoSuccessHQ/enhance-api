<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\NetworkStatus;

/**
 * DTO for the ServiceInfo schema.
 */
class ServiceInfo extends AbstractDto
{
    public ?string $id = null;

    public ?string $version = null;

    public ?NetworkStatus $status = null;

    public ?int $port = null;

    public ?int $usage = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\ProcessInfo> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ProcessInfo::class)]
    public ?array $processes = null;
}
