<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DomainSslCert schema.
 */
class DomainSslCert extends AbstractDto
{
    public ?string $cn = null;

    public ?string $expires = null;

    public ?string $issued = null;

    public ?string $issuer = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $sans = null;

    public ?bool $forceHttps = null;
}
