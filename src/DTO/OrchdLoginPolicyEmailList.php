<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Email white or black list for orchd login policy
 */
class OrchdLoginPolicyEmailList extends AbstractDto
{
    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $emailList = null;
}
