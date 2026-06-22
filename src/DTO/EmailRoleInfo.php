<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\ServerRoleState;

/**
 * DTO for the EmailRoleInfo schema.
 */
class EmailRoleInfo extends AbstractDto
{
    public ?ServerRoleState $state = null;

    public ?int $usage = null;

    public ?int $mailboxCount = null;

    public ?int $failedDeliveryCount = null;

    /** The number of websites whose emails are assigned to be on this email role. */
    public ?int $websitesCount = null;
}
