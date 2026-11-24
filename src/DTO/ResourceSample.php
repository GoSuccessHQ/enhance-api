<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ResourceSample schema.
 *
 * One cgroup resource usage sample of a website. Counter fields (cpuUsec and the per-device IO counters) are raw
 * cumulative counters; derive rates from the deltas between consecutive samples, and treat a negative delta (cgroup
 * reset) as a gap. Gauge fields (memory, swap, pids) are point-in-time values.
 */
class ResourceSample extends AbstractDto
{
    /** Sample time, unix seconds (UTC). */
    public ?int $datetime = null;

    /** cpu.stat usage_usec, raw cumulative counter. */
    public ?int $cpuUsec = null;

    /** cpu.max quota / period, the effective vCPU count; omitted when unlimited. */
    public ?float $cpuVcpusLimit = null;

    /** memory.current */
    public ?int $memoryBytes = null;

    /** memory.max; omitted when unlimited. */
    public ?int $memoryLimitBytes = null;

    /** Net swap, memory.swap.current - memory.current. */
    public ?int $swapBytes = null;

    /** Net swap limit, memory.swap.max - memory.max; omitted unless both are configured. */
    public ?int $swapLimitBytes = null;

    /** pids.current */
    public ?int $pids = null;

    /** pids.max; omitted when unlimited. */
    public ?int $pidsLimit = null;

    /**
     * One entry per device reported by io.stat or io.max.
     *
     * @var array<int, \GoSuccess\Enhance\DTO\ResourceSampleIoDevice>
     */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\ResourceSampleIoDevice::class)]
    public ?array $ioDevices = null;
}
