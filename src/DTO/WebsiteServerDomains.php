<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsiteServerDomains schema.
 */
class WebsiteServerDomains extends AbstractDto
{
    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $appServerDomains = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $emailServerDomains = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $dbServerDomains = null;
}
