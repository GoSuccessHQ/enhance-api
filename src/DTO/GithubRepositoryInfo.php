<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\GithubLanguage;
use GoSuccess\Enhance\Enum\GithubRepositoryVisibility;

/**
 * DTO for the GithubRepositoryInfo schema.
 */
class GithubRepositoryInfo extends AbstractDto
{
    public ?float $id = null;

    public ?string $name = null;

    public ?string $full_name = null;

    public ?bool $private = null;

    public ?string $clone_url = null;

    public ?string $default_branch = null;

    public ?GithubLanguage $language = null;

    public ?GithubRepositoryVisibility $visibility = null;

    /** @var array<string, mixed> */
    public ?array $owner = null;
}
