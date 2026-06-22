<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WebsiteOperation;

/**
 * DTO for the WebsiteOperationValidation schema.
 */
class WebsiteOperationValidation extends AbstractDto
{
    public ?WebsiteOperation $operation = null;

    public ?ChangeSubscriptionParams $params = null;
}
