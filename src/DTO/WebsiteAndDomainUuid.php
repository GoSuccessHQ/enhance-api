<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsiteAndDomainUuid schema.
 */
class WebsiteAndDomainUuid extends AbstractDto
{
    public ?string $websiteId = null;

    public ?string $domainId = null;
}
