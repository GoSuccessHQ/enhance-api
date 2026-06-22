<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\InstallWpPlugin;
use GoSuccess\Enhance\DTO\InstallWpThemeRequest;
use GoSuccess\Enhance\DTO\NewWpUser;
use GoSuccess\Enhance\DTO\UpdateWpPlugin;
use GoSuccess\Enhance\DTO\UpdateWpSettings;
use GoSuccess\Enhance\DTO\UpdateWpUser;
use GoSuccess\Enhance\DTO\WordPressInfo;
use GoSuccess\Enhance\DTO\WpInstallation;
use GoSuccess\Enhance\DTO\WpLatestVersion;
use GoSuccess\Enhance\DTO\WpPluginsFullListing;
use GoSuccess\Enhance\DTO\WpSettings;
use GoSuccess\Enhance\DTO\WpThemesFullListing;
use GoSuccess\Enhance\DTO\WpUser;
use GoSuccess\Enhance\DTO\WpUsersFullListing;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Enum\MaintenanceMode;
use GoSuccess\Enhance\Enum\MaintenanceModeStatus;

/**
 * Operations for the "wordpress" section of the Enhance API.
 */
final class WordpressResource extends AbstractResource
{
    /**
     * Get WordPress latest available version
     *
     * Returns the latest available WordPress version as published by the WordPress APIs.
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressLatestVersion
     * GET /utils/wordpress/latest
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WpLatestVersion|null
     */
    public function getWordpressLatestVersion(): ?WpLatestVersion
    {
        $response = $this->client->request(HttpMethod::GET, '/utils/wordpress/latest');

        return $response->decoded !== null ? WpLatestVersion::fromArray($response->decoded) : null;
    }

    /**
     * Trigger discovery of WP installations
     *
     * WP installations that were made manually (aside from invoking) orchd APIs aren't immediately discovered by orchd.
     * Invoking this endpoint triggers the discovery and adds installation info to the database.
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressInstallations
     * GET /orgs/{org_id}/websites/{website_id}/apps/wordpress
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WpInstallation[]
     */
    public function getWordpressInstallations(string $websiteId, ?string $orgId = null): array
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/wordpress");

        return array_map(static fn (array $item): WpInstallation => WpInstallation::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Get Wordpress application settings
     *
     * Queries an existing Wordpress application's settings.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressSettings
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WpSettings|null
     */
    public function getWordpressSettings(string $websiteId, string $appId, ?string $orgId = null): ?WpSettings
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress");

        return $response->decoded !== null ? WpSettings::fromArray($response->decoded) : null;
    }

    /**
     * Update Wordpress app settings
     *
     * Updates an existing website WP application's settings.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/updateWordpressSettings
     * PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param UpdateWpSettings $updateWpSettings
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWordpressSettings(
        string $websiteId,
        string $appId,
        UpdateWpSettings $updateWpSettings,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress", [], $updateWpSettings);

        return $response->isSuccess;
    }

    /**
     * Get WordPress version
     *
     * Fetches the WordPress version of a running installation in real time.
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressAppVersion
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/version
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function getWordpressAppVersion(string $websiteId, string $appId, ?string $orgId = null): mixed
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/version");

        return $response->decoded;
    }

    /**
     * Update website WP app to specific version or latest
     *
     * Updates an existing website Wordpress application's version to given version (defaults to latest). If the installation is already on its latest version, returns 200 without doing any work.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/updateWordpressAppVersion
     * PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/version
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWordpressAppVersion(string $websiteId, string $appId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/version");

        return $response->isSuccess;
    }

    /**
     * Get website WordPress themes
     *
     * Returns the themes installed on website's WordPress.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressThemes
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param bool|null $refreshCache If set to true, it will bypass internal caching.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WpThemesFullListing|null
     */
    public function getWordpressThemes(
        string $websiteId,
        string $appId,
        ?bool $refreshCache = null,
        ?string $orgId = null,
    ): ?WpThemesFullListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'refreshCache' => $refreshCache,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/themes", $query);

        return $response->decoded !== null ? WpThemesFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Install a WordPress theme
     *
     * @link https://apidocs.enhance.com/#/wordpress/installWordpressTheme
     * POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param InstallWpThemeRequest $installWpThemeRequest
     * @param bool|null $refreshCache If set to true, it will bypass internal caching.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function installWordpressTheme(
        string $websiteId,
        string $appId,
        InstallWpThemeRequest $installWpThemeRequest,
        ?bool $refreshCache = null,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $query = [
            'refreshCache' => $refreshCache,
        ];
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/themes", $query, $installWpThemeRequest);

        return $response->isSuccess;
    }

    /**
     * Delete a WordPress theme
     *
     * @link https://apidocs.enhance.com/#/wordpress/deleteWordpressTheme
     * DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $theme The name of the wordpress theme (not file name!).
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWordpressTheme(string $websiteId, string $appId, string $theme, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/themes/{$theme}");

        return $response->isSuccess;
    }

    /**
     * Update a WordPress theme
     *
     * @link https://apidocs.enhance.com/#/wordpress/updateWordpressTheme
     * POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}/update
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $theme The name of the wordpress theme (not file name!).
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWordpressTheme(string $websiteId, string $appId, string $theme, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/themes/{$theme}/update");

        return $response->isSuccess;
    }

    /**
     * Activate a WordPress theme
     *
     * @link https://apidocs.enhance.com/#/wordpress/activateWordpressTheme
     * POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}/activate
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $theme The name of the wordpress theme (not file name!).
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function activateWordpressTheme(
        string $websiteId,
        string $appId,
        string $theme,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/themes/{$theme}/activate");

        return $response->isSuccess;
    }

    /**
     * Set WordPress theme auto-update status
     *
     * @link https://apidocs.enhance.com/#/wordpress/setWordpressThemeAutoUpdateStatus
     * PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}/auto_update
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $theme The name of the wordpress theme (not file name!).
     * @param bool $value
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWordpressThemeAutoUpdateStatus(
        string $websiteId,
        string $appId,
        string $theme,
        ?bool $value,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/themes/{$theme}/auto_update", [], $value);

        return $response->isSuccess;
    }

    /**
     * Returns the users of this wordpress app.
     * This is a separate endpoint as it is takes longer to return than most other endpoints.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressUsers
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WpUsersFullListing|null
     */
    public function getWordpressUsers(string $websiteId, string $appId, ?string $orgId = null): ?WpUsersFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/users");

        return $response->decoded !== null ? WpUsersFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create website WordPress user
     *
     * Creates a new user in this wordpress app.
     * The created user is independent from Enhance logins--it only concerns the wordpress app (which much like Enhance is its own webapp).
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/createWordpressUser
     * POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param NewWpUser $newWpUser
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createWordpressUser(
        string $websiteId,
        string $appId,
        NewWpUser $newWpUser,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/users", [], $newWpUser);

        return $response->isSuccess;
    }

    /**
     * Return previously set default Wordpress SSO user. If WP users exist but none were set to be default, returns 404.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/getDefaultWpSsoUser
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/default
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WpUser|null
     */
    public function getDefaultWpSsoUser(string $websiteId, string $appId, ?string $orgId = null): ?WpUser
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/users/default");

        return $response->decoded !== null ? WpUser::fromArray($response->decoded) : null;
    }

    /**
     * Set WP user as the default SSO user for that website.
     *
     * Idempotently set WP user as the default SSO user for that website.
     * User needs to exist.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/setDefaultWpSsoUser
     * PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/default
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param mixed $body
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setDefaultWpSsoUser(string $websiteId, string $appId, mixed $body, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/users/default", [], $body);

        return $response->isSuccess;
    }

    /**
     * Update WordPress user
     *
     * Updates an existing user in this wordpress app.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/updateWordpressUser
     * PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/{user_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param int $userId The id of the wordpress user.
     * @param UpdateWpUser $updateWpUser
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWordpressUser(
        string $websiteId,
        string $appId,
        int $userId,
        UpdateWpUser $updateWpUser,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/users/{$userId}", [], $updateWpUser);

        return $response->isSuccess;
    }

    /**
     * Delete WordPress user
     *
     * Deletes an existing user in this wordpress app.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/deleteWordpressUser
     * DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/{user_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param int $userId The id of the wordpress user.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWordpressUser(string $websiteId, string $appId, int $userId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/users/{$userId}");

        return $response->isSuccess;
    }

    /**
     * Get SSO URL for a WP user
     *
     * Session holder must have write access to the website
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressUserSsoUrl
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/{user_id}/sso
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param int $userId The id of the wordpress user.
     * @param bool|null $shouldRedirect If set to true, the endpoint will send a 307 redirect to the SSO URL.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getWordpressUserSsoUrl(
        string $websiteId,
        string $appId,
        int $userId,
        ?bool $shouldRedirect = null,
        ?string $orgId = null,
    ): ?string {
        $orgId = $this->orgId($orgId);
        $query = [
            'shouldRedirect' => $shouldRedirect,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/users/{$userId}/sso", $query);

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Get the WP config value for a given option
     *
     * Returns the value of a wp-config.php entry.
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressConfig
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/wp-config/{wp_option}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $wpOption The wordpress config option.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function getWordpressConfig(
        string $websiteId,
        string $appId,
        string $wpOption,
        ?string $orgId = null,
    ): mixed {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/wp-config/{$wpOption}");

        return $response->decoded;
    }

    /**
     * Set a single value of a wp-config.php entry.
     *
     * @link https://apidocs.enhance.com/#/wordpress/setWordpressConfig
     * PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/wp-config
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param mixed $body
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWordpressConfig(string $websiteId, string $appId, mixed $body, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/wp-config", [], $body);

        return $response->isSuccess;
    }

    /**
     * Get website WordPress plugins
     *
     * Returns the plugins installed on wordpress.
     * This is a separate endpoint as it is takes longer to return than the rest of the application endpoints.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressPlugins
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param bool|null $refreshCache If set to true, it will bypass internal caching.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WpPluginsFullListing|null
     */
    public function getWordpressPlugins(
        string $websiteId,
        string $appId,
        ?bool $refreshCache = null,
        ?string $orgId = null,
    ): ?WpPluginsFullListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'refreshCache' => $refreshCache,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/plugins", $query);

        return $response->decoded !== null ? WpPluginsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Install a plugin
     *
     * Adds a specific plugin to a WordPress installation.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/installWordpressPlugin
     * POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param InstallWpPlugin $installWpPlugin
     * @param bool|null $refreshCache If set to true, it will bypass internal caching.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function installWordpressPlugin(
        string $websiteId,
        string $appId,
        InstallWpPlugin $installWpPlugin,
        ?bool $refreshCache = null,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $query = [
            'refreshCache' => $refreshCache,
        ];
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/plugins", $query, $installWpPlugin);

        return $response->isSuccess;
    }

    /**
     * Updates website WordPress plugin settings
     *
     * Updates the settings for a WP plugin, such as whether the plugin should be active.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/updateWordpressPluginSettings
     * PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins/{plugin}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $plugin The name of the wordpress plugin (not file name!).
     * @param UpdateWpPlugin $updateWpPlugin
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWordpressPluginSettings(
        string $websiteId,
        string $appId,
        string $plugin,
        UpdateWpPlugin $updateWpPlugin,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/plugins/{$plugin}", [], $updateWpPlugin);

        return $response->isSuccess;
    }

    /**
     * Delete website WordPress plugin
     *
     * Deletes the specified wordpress plugin.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/deleteWordpressPlugin
     * DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins/{plugin}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $plugin The name of the wordpress plugin (not file name!).
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWordpressPlugin(
        string $websiteId,
        string $appId,
        string $plugin,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/plugins/{$plugin}");

        return $response->isSuccess;
    }

    /**
     * Updates website WordPress plugin to latest version
     *
     * Updates the specified wordpress plugin to its latest version. Does nothing if the plugin is already latest.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/wordpress/updateWordpressPluginToLatest
     * PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins/{plugin}/version
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $plugin The name of the wordpress plugin (not file name!).
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWordpressPluginToLatest(
        string $websiteId,
        string $appId,
        string $plugin,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/plugins/{$plugin}/version");

        return $response->isSuccess;
    }

    /**
     * Fetches the site URL for a WordPress installation
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordPressSiteurl
     * GET /v2/apps/{app_id}/wordpress/url
     *
     * @param string $appId The id of the app.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getWordPressSiteurl(string $appId): ?string
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/apps/{$appId}/wordpress/url");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Sets the site URL for a WordPress installation
     *
     * @link https://apidocs.enhance.com/#/wordpress/setWordPressSiteurl
     * PUT /v2/apps/{app_id}/wordpress/url
     *
     * @param string $appId The id of the app.
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWordPressSiteurl(string $appId, ?string $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/apps/{$appId}/wordpress/url", [], $value);

        return $response->isSuccess;
    }

    /**
     * Gets the MaintenanceMode for a WordPress installation
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordPressMaintenanceMode
     * GET /v2/apps/{app_id}/wordpress/maintenance-mode
     *
     * @param string $appId The id of the app.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MaintenanceModeStatus|null
     */
    public function getWordPressMaintenanceMode(string $appId): ?MaintenanceModeStatus
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/apps/{$appId}/wordpress/maintenance-mode");

        return \is_string($response->decoded) || \is_int($response->decoded) ? MaintenanceModeStatus::tryFrom($response->decoded) : null;
    }

    /**
     * Sets the MaintenanceMode for a WordPress installation
     *
     * @link https://apidocs.enhance.com/#/wordpress/setWordPressMaintenanceMode
     * PUT /v2/apps/{app_id}/wordpress/maintenance-mode
     *
     * @param string $appId The id of the app.
     * @param MaintenanceMode $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWordPressMaintenanceMode(string $appId, MaintenanceMode $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/apps/{$appId}/wordpress/maintenance-mode", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get WordPress installation info
     *
     * @link https://apidocs.enhance.com/#/wordpress/getWordpressInfo
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/info
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WordPressInfo|null
     */
    public function getWordpressInfo(string $websiteId, string $appId, ?string $orgId = null): ?WordPressInfo
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/wordpress/info");

        return $response->decoded !== null ? WordPressInfo::fromArray($response->decoded) : null;
    }
}
