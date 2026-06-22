<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WebsiteCloneEnumStatus;

/**
 * DTO for the WebsiteCloneResponse schema.
 */
class WebsiteCloneResponse extends AbstractDto
{
    public ?string $id = null;

    public ?string $sourceWebsiteId = null;

    public ?string $destWebsiteId = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $excludePaths = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $includeDatabases = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $includeDatabaseUsers = null;

    public ?bool $deleteFilesFromDestination = null;

    public ?WebsiteCloneEnumStatus $status = null;

    public ?bool $syncPhpVersion = null;
}
