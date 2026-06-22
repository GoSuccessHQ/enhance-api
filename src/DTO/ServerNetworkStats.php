<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ServerNetworkStats schema.
 */
class ServerNetworkStats extends AbstractDto
{
    /** Latency to the server in milliseconds. */
    public ?float $latency = null;

    /** Packet loss percentage */
    public ?float $packetLoss = null;
}
