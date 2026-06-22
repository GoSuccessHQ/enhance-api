<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\LicenceInfo;
use GoSuccess\Enhance\DTO\LicenceKey;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "licence" section of the Enhance API.
 */
final class LicenceResource extends AbstractResource
{
    /**
     * Get current licence status
     *
     * @link https://apidocs.enhance.com/#/licence/getLicenceInfo
     * GET /licence
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LicenceInfo|null
     */
    public function getLicenceInfo(): ?LicenceInfo
    {
        $response = $this->client->request(HttpMethod::GET, '/licence');

        return \is_array($response->decoded) ? LicenceInfo::fromArray($response->decoded) : null;
    }

    /**
     * Updates licence key if provided, and refresh licence status by calling home servers. NOTE: calling without any licence_key body, only refreshes the current licence status
     *
     * @link https://apidocs.enhance.com/#/licence/refreshLicence
     * PUT /licence
     *
     * @param LicenceKey $licenceKey
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LicenceInfo|null
     */
    public function refreshLicence(?LicenceKey $licenceKey = null): ?LicenceInfo
    {
        $response = $this->client->request(HttpMethod::PUT, '/licence', [], $licenceKey);

        return \is_array($response->decoded) ? LicenceInfo::fromArray($response->decoded) : null;
    }
}
