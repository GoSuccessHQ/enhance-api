<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsiteCloneRequest schema.
 */
class WebsiteCloneRequest extends AbstractDto
{
    public ?bool $runWpSearchReplace = null;

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

    public ?bool $syncPhpVersion = null;

    public ?WebsiteCloneNewWebsite $newWebsite = null;
}
