<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "reports" section of the Enhance API.
 */
final class ReportsResource extends AbstractResource
{
    /**
     * Get blocked ips
     *
     * Returns a list of all currently active blocked ips.
     *
     * @link https://apidocs.enhance.com/#/reports/getLoginPolicyBlockedIps
     * GET /reports/orchd/login-policy/blocked-ips
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function getLoginPolicyBlockedIps(): mixed
    {
        $response = $this->client->request(HttpMethod::GET, '/reports/orchd/login-policy/blocked-ips');

        return $response->decoded;
    }

    /**
     * Get blocked logins
     *
     * Returns a list of all currently active blocked logins and ips.
     *
     * @link https://apidocs.enhance.com/#/reports/getLoginPolicyBlockedLogins
     * GET /reports/orchd/login-policy/blocked-logins
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function getLoginPolicyBlockedLogins(): mixed
    {
        $response = $this->client->request(HttpMethod::GET, '/reports/orchd/login-policy/blocked-logins');

        return $response->decoded;
    }
}
