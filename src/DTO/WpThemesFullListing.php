<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WpThemesFullListing schema.
 */
class WpThemesFullListing extends AbstractDto
{
    /** @var array<int, \GoSuccess\Enhance\DTO\WpTheme> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\WpTheme::class)]
    public ?array $items = null;
}
