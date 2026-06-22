<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\InstallableWebsiteAppsFullListing;
use GoSuccess\Enhance\DTO\ListedPersistentApp;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\NewWebsiteApp;
use GoSuccess\Enhance\DTO\PersistentApp;
use GoSuccess\Enhance\DTO\UpdatePersistentApp;
use GoSuccess\Enhance\DTO\WebsiteAppsFullListing;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "apps" section of the Enhance API.
 */
final class AppsResource extends AbstractResource
{
    /**
     * Get all installable applications
     *
     * Returns all installable applications. Note that what apps can be installed on a website is ultimately decided by customer's subscription.
     * See operationId `getInstallableApps`.
     *
     * @link https://apidocs.enhance.com/#/apps/getGlobalInstallableApps
     * GET /utils/installable-apps
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return InstallableWebsiteAppsFullListing|null
     */
    public function getGlobalInstallableApps(): ?InstallableWebsiteAppsFullListing
    {
        $response = $this->client->request(HttpMethod::GET, '/utils/installable-apps');

        return \is_array($response->decoded) ? InstallableWebsiteAppsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Get installable website applications
     *
     * Returns all installable applications under the subscription.
     *
     * @link https://apidocs.enhance.com/#/apps/getInstallableApps
     * GET /orgs/{org_id}/subscriptions/{subscription_id}/installable-apps
     *
     * @param float $subscriptionId The id of the subscription.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return InstallableWebsiteAppsFullListing|null
     */
    public function getInstallableApps(
        float $subscriptionId,
        ?string $orgId = null,
    ): ?InstallableWebsiteAppsFullListing {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/subscriptions/{$subscriptionId}/installable-apps");

        return \is_array($response->decoded) ? InstallableWebsiteAppsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Get website applications
     *
     * Returns all applications installed on this website.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/apps/getWebsiteApps
     * GET /orgs/{org_id}/websites/{website_id}/apps
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsiteAppsFullListing|null
     */
    public function getWebsiteApps(string $websiteId, ?string $orgId = null): ?WebsiteAppsFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps");

        return \is_array($response->decoded) ? WebsiteAppsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create website applications
     *
     * Creates a new application for website.
     * Note that if the installed app is WordPress, this endpoint will enable PHP for the website if it isn't already.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/apps/createWebsiteApp
     * POST /orgs/{org_id}/websites/{website_id}/apps
     *
     * @param string $websiteId The id of the website.
     * @param NewWebsiteApp $newWebsiteApp
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createWebsiteApp(
        string $websiteId,
        NewWebsiteApp $newWebsiteApp,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/apps", [], $newWebsiteApp);

        return \is_array($response->decoded) ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Delete website app
     *
     * Deletes an existing website app. Unless `backupBeforeOperation=false` query param is sent, it runs a website backup before deleting the app.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/apps/deleteWebsiteApp
     * DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param bool|null $backupBeforeOperation Whether a backup should be ran before the endpoint operation is executed.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteApp(
        string $websiteId,
        string $appId,
        ?bool $backupBeforeOperation = null,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $query = [
            'backupBeforeOperation' => $backupBeforeOperation,
        ];
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}", $query);

        return $response->isSuccess;
    }

    /**
     * Get website persistent applications
     *
     * List all persistent applications belonging to this website
     *
     * @link https://apidocs.enhance.com/#/apps/getWebsitePersistentApps
     * GET /websites/{website_id}/apps/persistent
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ListedPersistentApp[]
     */
    public function getWebsitePersistentApps(string $websiteId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/apps/persistent");

        return array_map(static fn (array $item): ListedPersistentApp => ListedPersistentApp::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Create a persistent application
     *
     * Create an application that will be started automatically within the website container and restarted if it fails.  Set a port to proxy from the web server to the running application.
     *
     * @link https://apidocs.enhance.com/#/apps/createWebsitePersistentApp
     * POST /websites/{website_id}/apps/persistent
     *
     * @param string $websiteId The id of the website.
     * @param PersistentApp $persistentApp
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createWebsitePersistentApp(string $websiteId, PersistentApp $persistentApp): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/websites/{$websiteId}/apps/persistent", [], $persistentApp);

        return $response->isSuccess;
    }

    /**
     * Get the log for a persistent app
     *
     * @link https://apidocs.enhance.com/#/apps/getWebsitePersistentAppLog
     * GET /websites/{website_id}/apps/persistent/{app_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getWebsitePersistentAppLog(string $websiteId, string $appId): ?string
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/apps/persistent/{$appId}");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Update a persistent application
     *
     * Update settings for this application, for example startMode
     *
     * @link https://apidocs.enhance.com/#/apps/updateWebsitePersistentApp
     * PATCH /websites/{website_id}/apps/persistent/{app_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param UpdatePersistentApp $updatePersistentApp
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsitePersistentApp(
        string $websiteId,
        string $appId,
        UpdatePersistentApp $updatePersistentApp,
    ): bool {
        $response = $this->client->request(HttpMethod::PATCH, "/websites/{$websiteId}/apps/persistent/{$appId}", [], $updatePersistentApp);

        return $response->isSuccess;
    }

    /**
     * Delete a persistent app
     *
     * @link https://apidocs.enhance.com/#/apps/deleteWebsitePersistentApp
     * DELETE /websites/{website_id}/apps/persistent/{app_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsitePersistentApp(string $websiteId, string $appId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/websites/{$websiteId}/apps/persistent/{$appId}");

        return $response->isSuccess;
    }

    /**
     * Install nvm and default stable node to this website
     *
     * @link https://apidocs.enhance.com/#/apps/installNvm
     * POST /websites/{website_id}/apps/node
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function installNvm(string $websiteId): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/websites/{$websiteId}/apps/node");

        return $response->isSuccess;
    }

    /**
     * Get possible versions of node to install from nvm
     *
     * @link https://apidocs.enhance.com/#/apps/getPossibleNodeVersions
     * GET /websites/{website_id}/apps/node/possible_versions
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function getPossibleNodeVersions(string $websiteId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/apps/node/possible_versions");

        return (array)($response->decoded ?? []);
    }

    /**
     * List installed Node versions with NVM
     *
     * @link https://apidocs.enhance.com/#/apps/listInstalledNodeVersions
     * GET /websites/{website_id}/apps/node/versions
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function listInstalledNodeVersions(string $websiteId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/apps/node/versions");

        return (array)($response->decoded ?? []);
    }

    /**
     * Install a specific version of Node with NVM
     *
     * @link https://apidocs.enhance.com/#/apps/installNodeVersion
     * POST /websites/{website_id}/apps/node/versions
     *
     * @param string $websiteId The id of the website.
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function installNodeVersion(string $websiteId, ?string $value): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/websites/{$websiteId}/apps/node/versions", [], $value);

        return $response->isSuccess;
    }

    /**
     * Set default node version
     *
     * @link https://apidocs.enhance.com/#/apps/setDefaultNodeVersion
     * PUT /websites/{website_id}/apps/node/versions/default
     *
     * @param string $websiteId The id of the website.
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setDefaultNodeVersion(string $websiteId, ?string $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/websites/{$websiteId}/apps/node/versions/default", [], $value);

        return $response->isSuccess;
    }
}
