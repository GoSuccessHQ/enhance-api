<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the SetupResult schema.
 */
class SetupResult extends AbstractDto
{
    public ?string $loginId = null;

    public ?string $memberId = null;

    public ?string $orgId = null;

    public ?string $serverId = null;

    public ?string $controlPanelWebsiteId = null;
}
