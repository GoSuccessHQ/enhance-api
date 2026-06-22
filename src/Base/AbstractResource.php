<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Base;

use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Contract\HttpClientInterface;

/**
 * Base class for all API resources, holding the HTTP client and configuration.
 */
abstract class AbstractResource
{
    public function __construct(
        protected readonly HttpClientInterface $client,
        protected readonly Configuration $config,
    ) {
    }

    /**
     * Resolve the organization id, falling back to the configured default.
     */
    protected function orgId(?string $orgId): string
    {
        return $orgId ?? $this->config->orgId;
    }
}
