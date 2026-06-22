<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Client;

/**
 * Holds all configuration for the Enhance API client.
 *
 * Uses PHP 8.4 property hooks for normalization and validation.
 */
final class Configuration
{
    /**
     * Base URL of the Enhance API, e.g. https://cp.example.com/api (trailing slash trimmed).
     */
    public string $host {
        set {
            $value = rtrim($value, '/');

            if ($value === '') {
                throw new \InvalidArgumentException('Host cannot be empty');
            }

            $this->host = $value;
        }
    }

    /**
     * Default organization id used for endpoints scoped to {org_id}.
     */
    public string $orgId;

    /**
     * Bearer access token used for authentication.
     */
    public string $accessToken {
        set {
            if ($value === '') {
                throw new \InvalidArgumentException('Access token cannot be empty');
            }

            $this->accessToken = $value;
        }
    }

    /**
     * Request timeout in seconds (minimum 1).
     */
    public int $timeout = 30 {
        set {
            if ($value < 1) {
                throw new \InvalidArgumentException('Timeout must be at least 1 second');
            }

            $this->timeout = $value;
        }
    }

    /**
     * Connection timeout in seconds (minimum 1).
     */
    public int $connectTimeout = 10 {
        set {
            if ($value < 1) {
                throw new \InvalidArgumentException('Connect timeout must be at least 1 second');
            }

            $this->connectTimeout = $value;
        }
    }

    /**
     * Maximum number of retry attempts for transient failures (minimum 0).
     */
    public int $maxRetries = 2 {
        set {
            if ($value < 0) {
                throw new \InvalidArgumentException('Max retries cannot be negative');
            }

            $this->maxRetries = $value;
        }
    }

    /**
     * Whether to verify the peer's TLS certificate. Enabled by default.
     */
    public bool $verifySsl = true;

    /**
     * User agent sent with every request.
     */
    public string $userAgent = 'GoSuccess-Enhance-API-Client/1.0 (+https://github.com/GoSuccessHQ/enhance-api)';

    public function __construct(string $host, string $orgId, string $accessToken)
    {
        $this->host = $host;
        $this->orgId = $orgId;
        $this->accessToken = $accessToken;
    }
}
