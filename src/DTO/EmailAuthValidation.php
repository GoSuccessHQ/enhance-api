<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the EmailAuthValidation schema.
 */
class EmailAuthValidation extends AbstractDto
{
    public ?bool $dkimIsValid = null;

    public ?bool $spfIsValid = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $foundTxtRecordsDkim = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $foundTxtRecordsSpf = null;
}
