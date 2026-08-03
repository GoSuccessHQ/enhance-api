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
     *
     * Validated here rather than on the Configuration so that the endpoints
     * which are not scoped to an organization stay usable without one.
     *
     * @throws \InvalidArgumentException When neither an explicit nor a configured id is available
     */
    protected function orgId(?string $orgId): string
    {
        $resolved = $orgId ?? $this->config->orgId;

        if (trim($resolved) === '') {
            throw new \InvalidArgumentException(
                'This endpoint is scoped to an organization, but no organization id was given: '
                . 'pass one to the method or configure a default one.',
            );
        }

        return $resolved;
    }
}
