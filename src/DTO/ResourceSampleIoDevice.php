<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ResourceSampleIoDevice schema.
 *
 * Cumulative IO counters of one block device merged with the per-device limits configured in io.max. Throughput and
 * IOPS are the delta between consecutive samples divided by the elapsed time.
 */
class ResourceSampleIoDevice extends AbstractDto
{
    /** Block device, "major:minor". */
    public ?string $device = null;

    /** io.stat rbytes, raw cumulative counter. */
    public ?int $readBytes = null;

    /** io.stat wbytes, raw cumulative counter. */
    public ?int $writeBytes = null;

    /** io.stat rios, raw cumulative counter. */
    public ?int $readOps = null;

    /** io.stat wios, raw cumulative counter. */
    public ?int $writeOps = null;

    /** io.max rbps; omitted when unlimited. */
    public ?int $readBytesLimit = null;

    /** io.max wbps; omitted when unlimited. */
    public ?int $writeBytesLimit = null;

    /** io.max riops; omitted when unlimited. */
    public ?int $readOpsLimit = null;

    /** io.max wiops; omitted when unlimited. */
    public ?int $writeOpsLimit = null;

    /** Block device name (e.g. "vda"); omitted when it could not be determined. */
    public ?string $deviceName = null;

    /**
     * Mount points of the filesystems this disk carries, at most the three shortest.
     *
     * @var array<int, string>
     */
    #[ArrayItemType('string')]
    public ?array $mountPoints = null;

    /** Present when this disk only passes through the IO of a stacked device mounted above it; names that device. */
    public ?string $hiddenBehind = null;
}
