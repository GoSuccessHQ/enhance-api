<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the ImporterAnalyzedData schema.
 */
class ImporterAnalyzedData extends AbstractDto
{
    /** @var array<int, mixed> */
    public ?array $domains = null;

    /** @var array<int, mixed> */
    public ?array $mysqlDatabases = null;

    /** @var array<int, mixed> */
    public ?array $mysqlUsers = null;

    /** @var array<int, mixed> */
    public ?array $mysqlGrants = null;

    /** @var array<int, mixed> */
    public ?array $crontabs = null;

    /** @var array<int, mixed> */
    public ?array $ftps = null;

    /** @var array<int, mixed> */
    public ?array $mailboxes = null;
}
