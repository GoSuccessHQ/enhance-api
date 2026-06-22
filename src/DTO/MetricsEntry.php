<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Each Metrics entry represts an hourly window of banwidth usage Note: depending upon the polling time, most recent hour values might not
 *       be complete yet and are subject to change if fetched at a later time.
 */
class MetricsEntry extends AbstractDto
{
    /** Time at the beginning of the unit for this bandwidth consumption entry */
    public ?\DateTimeImmutable $datetime = null;

    public ?float $bytesReceived = null;

    public ?float $bytesSent = null;

    public ?float $uniqueHits = null;

    public ?float $botHits = null;

    public ?float $totalHits = null;
}
