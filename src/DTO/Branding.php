<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\CPLocale;

/**
 * DTO for the Branding schema.
 */
class Branding extends AbstractDto
{
    public ?string $orgName = null;

    public ?string $parent = null;

    public ?string $controlPanelDomain = null;

    public ?string $phpMyAdminDomain = null;

    public ?string $roundcubeDomain = null;

    public ?string $logoPath = null;

    public ?string $inverseLogoPath = null;

    public ?string $inverseIconPath = null;

    public ?string $loginImagePath = null;

    public ?string $faviconPath = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $nameServers = null;

    /** @var array<int, \GoSuccess\Enhance\DTO\Setting> */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\Setting::class)]
    public ?array $settings = null;

    public ?string $stagingDomain = null;

    public ?CPLocale $locale = null;
}
