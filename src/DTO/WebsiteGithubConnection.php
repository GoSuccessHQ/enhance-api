<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the WebsiteGithubConnection schema.
 */
class WebsiteGithubConnection extends AbstractDto
{
    public ?string $repoOwner = null;

    public ?string $repoName = null;

    public ?string $branchOrTagName = null;

    public ?string $buildCommand = null;

    /** If the build command produces static assets, enter the directory relative to the build directory where those assets are built, and the document root will be set to it. */
    public ?string $publishDirectory = null;

    /** Enhance will automatically deploy the latest commit of the selected branch or tag when a request is received from GitHub to the webhook URL. */
    public ?bool $autoDeploy = null;

    /** Takes one of `branch`, `tag`, `commit`. */
    public ?string $refKind = null;
}
