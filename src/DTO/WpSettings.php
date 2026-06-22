<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WPAutoUpdateCore;

/**
 * DTO for the WpSettings schema.
 */
class WpSettings extends AbstractDto
{
    public ?WPAutoUpdateCore $autoUpdateCore = null;

    public ?bool $disallowNonWpPhp = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $loginAccess = null;
}
