<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the EmailForwardersUpdate schema.
 */
class EmailForwardersUpdate extends AbstractDto
{
    /**
     * email addresses to forward to.
     * @var string[]
     */
    #[ArrayItemType('string')]
    public ?array $forwarders = null;
}
