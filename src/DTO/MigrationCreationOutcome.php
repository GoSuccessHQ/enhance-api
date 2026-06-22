<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * error and migrationId are mutually exclusive
 */
class MigrationCreationOutcome extends AbstractDto
{
    public ?HttpError $error = null;

    public ?string $migrationId = null;
}
