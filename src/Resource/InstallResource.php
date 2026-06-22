<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "install" section of the Enhance API.
 */
final class InstallResource extends AbstractResource
{
    /**
     * Get the SemVer of the API service
     *
     * @link https://apidocs.enhance.com/#/install/orchdVersion
     * GET /version
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function orchdVersion(): ?string
    {
        $response = $this->client->request(HttpMethod::GET, '/version');

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Get the readiness status of the orchd service
     *
     * @link https://apidocs.enhance.com/#/install/orchdStatus
     * GET /status
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function orchdStatus(): ?string
    {
        $response = $this->client->request(HttpMethod::GET, '/status');

        return $response->decoded === null ? null : (string)$response->decoded;
    }
}
