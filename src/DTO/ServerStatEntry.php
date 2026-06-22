<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Each entry represts server stats recorded periodically
 */
class ServerStatEntry extends AbstractDto
{
    public ?string $serverId = null;

    public ?float $ioWait = null;

    public ?float $ramUsage = null;

    public ?float $swapUsage = null;

    public ?float $systemLoad = null;

    public ?float $uptime = null;

    /** Time when the entry was recorded */
    public ?\DateTimeImmutable $recordedAt = null;
}
