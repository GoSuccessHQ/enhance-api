<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The type of the btrfs device, if `device` the block device must already exist, otherwise (with `sparseFile`) it will be created from a new (not existing) sparse file. In both cases the block device will be formatted to btrfs and mounted in the given mount point.
 */
enum DeviceKind: string
{
    case Device = 'device';

    case SparseFile = 'sparseFile';
}
