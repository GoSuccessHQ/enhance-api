<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * Tree starting from top level DNS and recursively going down to
 */
class TldNs extends AbstractDto
{
    public ?string $ip = null;

    /**
     * Tree of AuthNs servers
     * @var array<string, mixed>
     */
    public ?array $authNsMap = null;
}
