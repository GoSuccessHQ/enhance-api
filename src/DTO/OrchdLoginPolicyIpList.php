<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Ip white or black list for orchd login policy
 */
class OrchdLoginPolicyIpList extends AbstractDto
{
    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $ipList = null;
}
