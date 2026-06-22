<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the BackupRestoreOptions schema.
 */
class BackupRestoreOptions extends AbstractDto
{
    /** If set to false, the backup restoration will not include the website home directory. */
    public ?bool $restoreFiles = null;

    /**
     * Used in conjunction with the restoreFiles parameter, will limit the restoration to only the files/directories specified.
     * @var string[]
     */
    #[ArrayItemType('string')]
    public ?array $restoreOnlyFiles = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $restoreEmails = null;

    /** Restore all the mailboxes from this backup. Overrides the `restoreEmails` property. */
    public ?bool $restoreAllEmails = null;

    /**
     * The list of databases names that need to be restored. If this list is not specified all the databases found in the backup snapshot will be restored, otherwise if this list is specified as empty, no database will be restored.
     * @var string[]
     */
    #[ArrayItemType('string')]
    public ?array $restoreDatabases = null;

    /**
     * The list of PostgreSQL database names that need to be restored. If this list is not specified all the databases found in the backup snapshot will be restored, otherwise if this list is specified as empty, no database will be restored.
     * @var string[]
     */
    #[ArrayItemType('string')]
    public ?array $restorePostgresqlDatabases = null;
}
