<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\JoomlaInfo;
use GoSuccess\Enhance\DTO\JoomlaUsersFullListing;
use GoSuccess\Enhance\DTO\NewJoomlaUser;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "joomla" section of the Enhance API.
 */
final class JoomlaResource extends AbstractResource
{
    /**
     * Get Joomla installation info
     *
     * @link https://apidocs.enhance.com/#/joomla/getJoomlaInfo
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/info
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return JoomlaInfo|null
     */
    public function getJoomlaInfo(string $websiteId, string $appId, ?string $orgId = null): ?JoomlaInfo
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/joomla/info");

        return \is_array($response->decoded) ? JoomlaInfo::fromArray($response->decoded) : null;
    }

    /**
     * List all users of a Joomla installation
     *
     * @link https://apidocs.enhance.com/#/joomla/getJoomlaUsers
     * GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return JoomlaUsersFullListing|null
     */
    public function getJoomlaUsers(string $websiteId, string $appId, ?string $orgId = null): ?JoomlaUsersFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/joomla/users");

        return \is_array($response->decoded) ? JoomlaUsersFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create website Joomla user
     *
     * Add a user admin user to a Joomla installation
     *
     * @link https://apidocs.enhance.com/#/joomla/createJoomlaUser
     * POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param NewJoomlaUser $newJoomlaUser
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createJoomlaUser(
        string $websiteId,
        string $appId,
        NewJoomlaUser $newJoomlaUser,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/joomla/users", [], $newJoomlaUser);

        return $response->isSuccess;
    }

    /**
     * Delete a joomla user
     *
     * @link https://apidocs.enhance.com/#/joomla/deleteJoomlaUser
     * DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $username Joomla username
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteJoomlaUser(string $websiteId, string $appId, string $username, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/joomla/users/{$username}");

        return $response->isSuccess;
    }

    /**
     * Set the password for a given username
     *
     * @link https://apidocs.enhance.com/#/joomla/resetJoomlaUserPassword
     * PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}/password
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $username Joomla username
     * @param string $value
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function resetJoomlaUserPassword(
        string $websiteId,
        string $appId,
        string $username,
        ?string $value,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/joomla/users/{$username}/password", [], $value);

        return $response->isSuccess;
    }

    /**
     * Update the username for a given username
     *
     * @link https://apidocs.enhance.com/#/joomla/updateJoomlaUsername
     * PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}/username
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $username Joomla username
     * @param string $value
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateJoomlaUsername(
        string $websiteId,
        string $appId,
        string $username,
        ?string $value,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/joomla/users/{$username}/username", [], $value);

        return $response->isSuccess;
    }

    /**
     * Update the email address for a given username
     *
     * @link https://apidocs.enhance.com/#/joomla/updateJoomlaEmailAddress
     * PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}/email
     *
     * @param string $websiteId The id of the website.
     * @param string $appId The id of the app.
     * @param string $username Joomla username
     * @param string $value
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateJoomlaEmailAddress(
        string $websiteId,
        string $appId,
        string $username,
        ?string $value,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/apps/{$appId}/joomla/users/{$username}/email", [], $value);

        return $response->isSuccess;
    }
}
