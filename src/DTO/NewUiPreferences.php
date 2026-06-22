<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\UiPreferencesViewKind;

/**
 * DTO for the NewUiPreferences schema.
 */
class NewUiPreferences extends AbstractDto
{
    public ?UiPreferencesViewKind $fileManagerView = null;

    public ?UiPreferencesViewKind $websiteView = null;

    public ?bool $spineOpen = null;

    public ?bool $fileManagerEditorFullscreen = null;

    /** @var array<int, mixed> */
    public ?array $serverGroups = null;
}
