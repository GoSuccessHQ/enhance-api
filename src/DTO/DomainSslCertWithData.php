<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DomainSslCertWithData schema.
 */
class DomainSslCertWithData extends AbstractDto
{
    public ?string $cn = null;

    public ?string $expires = null;

    public ?string $issued = null;

    public ?string $issuer = null;

    /** @var string[] */
    #[ArrayItemType('string')]
    public ?array $sans = null;

    public ?string $cert = null;

    public ?string $key = null;

    public ?bool $forceHttps = null;
}
