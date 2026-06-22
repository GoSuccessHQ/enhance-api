<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\MysqlKind;
use GoSuccess\Enhance\Enum\NetworkStatus;

/**
 * DTO for the ServerInfo schema.
 */
class ServerInfo extends AbstractDto
{
    public ?string $id = null;

    public ?string $groupId = null;

    public ?bool $isControlPanel = null;

    public ?bool $isConfigured = null;

    public ?string $friendlyName = null;

    public ?string $hostname = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\ServerIp> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ServerIp::class)]
    public ?array $ips = null;

    public ?NetworkStatus $status = null;

    public ?RolesSummary $roles = null;

    public ?string $createdAt = null;

    public ?string $appcdVersion = null;

    public ?DedicatedSubscriptionInfo $dedicatedSubscription = null;

    public ?bool $isDecommissioned = null;

    public ?string $ipv6Addr = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Disk> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Disk::class)]
    public ?array $disks = null;

    public ?bool $updateRequired = null;

    public ?MysqlKind $mysqlKind = null;
}
