<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\GitDeployState;
use GoSuccess\Enhance\Enum\GitDeployTrigger;

/**
 * DTO for the GitDeployInfo schema.
 */
class GitDeployInfo extends AbstractDto
{
    public ?GitDeployState $state = null;

    public ?float $timeStamp = null;

    public ?string $branchOrTagName = null;

    public ?string $repositoryName = null;

    public ?string $commitRef = null;

    public ?string $deployId = null;

    public ?string $commitMessage = null;

    public ?float $percentageComplete = null;

    public ?GitDeployTrigger $trigger = null;
}
