<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Settings for orchd login policy
 */
class OrchdLoginPolicySettings extends AbstractDto
{
    public ?bool $enabled = null;

    public ?int $emailQuota = null;

    public ?bool $emailAutoBlockEnabled = null;

    public ?int $emailAutoBlockThreshold = null;

    public ?int $emailAutoBlockDuration = null;

    public ?int $ipQuota = null;

    public ?bool $ipAutoBlockEnabled = null;

    public ?int $ipAutoBlockThreshold = null;

    public ?int $ipAutoBlockDuration = null;
}
