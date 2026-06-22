<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\Branding;
use GoSuccess\Enhance\DTO\NewDomain;
use GoSuccess\Enhance\DTO\Setting;
use GoSuccess\Enhance\DTO\SettingsFullListing;
use GoSuccess\Enhance\DTO\StagingDomain;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "branding" section of the Enhance API.
 */
final class BrandingResource extends AbstractResource
{
    /**
     * Get default branding
     *
     * Returns the branding properties of an organization.
     * This endpoint doesn't require authentication so that a loginless user may query the control panel's reseller's branding. In this case, the request's Host HTTP header will be matched against an existing reseller's control panel host, and that reseller's branding returned.
     * To create a "control panel host" for the reseller, the reseller needs to create a control panel website using the website creation endpoint, specifying the control panel flag. For more details, please refer to `createWebsite`.
     * If, however, the user is logged in, the frontend should pass the currently logged in organization's id. Based on this, this endpoint will return the branding of that organization's realm's reseller. This means that if the user is currently logged into a reseller, that reseller's id would be passed and its branding would be returned. If the user is logged into a customer organization of a reseller, this endpoint looks up the parent of that customer and returns the branding of the parent.
     * An organization may not have any branding at all, in which case an "empty branding" is returned.
     *
     * @link https://apidocs.enhance.com/#/branding/getBranding
     * GET /branding
     *
     * @param string|null $orgId The id of the currently logged in organization.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Branding|null
     */
    public function getBranding(?string $orgId = null): ?Branding
    {
        $query = [
            'orgId' => $orgId,
        ];
        $response = $this->client->request(HttpMethod::GET, '/branding', $query);

        return $response->decoded !== null ? Branding::fromArray($response->decoded) : null;
    }

    /**
     * Get all current settings
     *
     * @link https://apidocs.enhance.com/#/branding/getBrandingSettings
     * GET /orgs/{org_id}/branding/settings
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return SettingsFullListing|null
     */
    public function getBrandingSettings(?string $orgId = null): ?SettingsFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/branding/settings");

        return $response->decoded !== null ? SettingsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create branding settings
     *
     * @link https://apidocs.enhance.com/#/branding/createBrandingSettings
     * POST /orgs/{org_id}/branding/settings
     *
     * @param array<int, mixed> $items
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createBrandingSettings(?array $items, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/branding/settings", [], $items);

        return $response->isSuccess;
    }

    /**
     * Get the specified setting
     *
     * @link https://apidocs.enhance.com/#/branding/getBrandingSetting
     * GET /orgs/{org_id}/branding/settings/{name}
     *
     * @param string $name The name of the resource.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Setting|null
     */
    public function getBrandingSetting(?string $name, ?string $orgId = null): ?Setting
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/branding/settings/{$name}");

        return $response->decoded !== null ? Setting::fromArray($response->decoded) : null;
    }

    /**
     * Create or update the specified setting
     *
     * @link https://apidocs.enhance.com/#/branding/updateBrandingSetting
     * PUT /orgs/{org_id}/branding/settings/{name}
     *
     * @param string $name The name of the resource.
     * @param string $value
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateBrandingSetting(?string $name, ?string $value, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/branding/settings/{$name}", [], $value);

        return $response->isSuccess;
    }

    /**
     * Remove the specified setting
     *
     * @link https://apidocs.enhance.com/#/branding/deleteBrandingSetting
     * DELETE /orgs/{org_id}/branding/settings/{name}
     *
     * @param string $name The name of the resource.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteBrandingSetting(?string $name, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/branding/settings/{$name}");

        return $response->isSuccess;
    }

    /**
     * Set brand logo
     *
     * Sets the reseller's brand logo, overwriting any previous one if one exists.
     * The max allowed size is 200 KiB. The image format may be jpeg, png, svg and ico.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/setBrandLogo
     * PUT /orgs/{org_id}/branding/logo
     *
     * @param array<string, mixed> $formData Multipart form fields.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setBrandLogo(?array $formData = null, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/branding/logo", [], $formData, 'multipart/form-data');

        return $response->isSuccess;
    }

    /**
     * Delete brand logo
     *
     * Deletes the brand's logo image
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/deleteBrandLogo
     * DELETE /orgs/{org_id}/branding/logo
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteBrandLogo(?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/branding/logo");

        return $response->isSuccess;
    }

    /**
     * Set brand inverse logo
     *
     * As per setBrandLogo except this logo will be displayed where there is a dark background.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/setBrandInverseLogo
     * PUT /orgs/{org_id}/branding/inverse-logo
     *
     * @param array<string, mixed> $formData Multipart form fields.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setBrandInverseLogo(?array $formData = null, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/branding/inverse-logo", [], $formData, 'multipart/form-data');

        return $response->isSuccess;
    }

    /**
     * Delete brand inverse logo
     *
     * Deletes the brand's logo inverse image
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/deleteInverseBrandLogo
     * DELETE /orgs/{org_id}/branding/inverse-logo
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteInverseBrandLogo(?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/branding/inverse-logo");

        return $response->isSuccess;
    }

    /**
     * Set brand inverse icon
     *
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/setBrandInverseIcon
     * PUT /orgs/{org_id}/branding/inverse-icon
     *
     * @param array<string, mixed> $formData Multipart form fields.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setBrandInverseIcon(?array $formData = null, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/branding/inverse-icon", [], $formData, 'multipart/form-data');

        return $response->isSuccess;
    }

    /**
     * Delete brand inverse icon
     *
     * Deletes the brand's icon inverse image
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/deleteBrandInverseIcon
     * DELETE /orgs/{org_id}/branding/inverse-icon
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteBrandInverseIcon(?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/branding/inverse-icon");

        return $response->isSuccess;
    }

    /**
     * Set brand login image
     *
     * Sets the reseller's brand login image, overwriting any previous one if one exists.
     * The max allowed size is 2 MiB. The image format may be jpeg, png, and ico.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/setBrandLoginImage
     * PUT /orgs/{org_id}/branding/login-image
     *
     * @param array<string, mixed> $formData Multipart form fields.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setBrandLoginImage(?array $formData = null, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/branding/login-image", [], $formData, 'multipart/form-data');

        return $response->isSuccess;
    }

    /**
     * Delete brand login image
     *
     * Deletes the reseller's brand login image
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/deleteBrandLoginImage
     * DELETE /orgs/{org_id}/branding/login-image
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteBrandLoginImage(?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/branding/login-image");

        return $response->isSuccess;
    }

    /**
     * Set brand favicon
     *
     * Sets the reseller's brand favicon, overwriting any previous one if one exists.
     * The max allowed size is 200 KiB. The image format may be jpeg, png, and ico.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/setBrandFavicon
     * PUT /orgs/{org_id}/branding/favicon
     *
     * @param array<string, mixed> $formData Multipart form fields.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setBrandFavicon(?array $formData = null, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/branding/favicon", [], $formData, 'multipart/form-data');

        return $response->isSuccess;
    }

    /**
     * Delete brand favicon
     *
     * Removes an existing favicon
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/branding/deleteBrandFavicon
     * DELETE /orgs/{org_id}/branding/favicon
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteBrandFavicon(?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/branding/favicon");

        return $response->isSuccess;
    }

    /**
     * Create reseller name server domain
     *
     * @link https://apidocs.enhance.com/#/branding/createNameServerDomain
     * POST /orgs/{org_id}/name-servers
     *
     * @param NewDomain $newDomain
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createNameServerDomain(NewDomain $newDomain, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/name-servers", [], $newDomain);

        return $response->isSuccess;
    }

    /**
     * Update reseller name server domain name
     *
     * @link https://apidocs.enhance.com/#/branding/updateNameServerDomain
     * PATCH /orgs/{org_id}/name-servers/{domain}
     *
     * @param string $domain The domain name.
     * @param NewDomain $newDomain
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateNameServerDomain(?string $domain, NewDomain $newDomain, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/name-servers/{$domain}", [], $newDomain);

        return $response->isSuccess;
    }

    /**
     * Delete reseller name server domain name
     *
     * @link https://apidocs.enhance.com/#/branding/deleteNameServerDomain
     * DELETE /orgs/{org_id}/name-servers/{domain}
     *
     * @param string $domain The domain name.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteNameServerDomain(?string $domain, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/name-servers/{$domain}");

        return $response->isSuccess;
    }

    /**
     * Fetches the staging domain which is currently set
     *
     * @link https://apidocs.enhance.com/#/branding/getStagingDomain
     * GET /orgs/{org_id}/staging-domain
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return StagingDomain|null
     */
    public function getStagingDomain(?string $orgId = null): ?StagingDomain
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/staging-domain");

        return $response->decoded !== null ? StagingDomain::fromArray($response->decoded) : null;
    }

    /**
     * Set or update domain suffix for staging websites created by customers
     *
     * @link https://apidocs.enhance.com/#/branding/setStagingDomain
     * POST /orgs/{org_id}/staging-domain
     *
     * @param StagingDomain $stagingDomain
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setStagingDomain(StagingDomain $stagingDomain, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/staging-domain", [], $stagingDomain);

        return $response->isSuccess;
    }
}
