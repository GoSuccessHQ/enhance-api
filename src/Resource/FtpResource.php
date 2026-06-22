<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\FtpUsersFullListing;
use GoSuccess\Enhance\DTO\FtpUserUpdate;
use GoSuccess\Enhance\DTO\NewFtpUser;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "ftp" section of the Enhance API.
 */
final class FtpResource extends AbstractResource
{
    /**
     * Returns all ftp users data for a given website
     *
     * Endpoint for retreaving ftp users for a given website
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/ftp/getFtpUsers
     * GET /orgs/{org_id}/websites/{website_id}/ftp/users
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return FtpUsersFullListing|null
     */
    public function getFtpUsers(string $websiteId, ?string $orgId = null): ?FtpUsersFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/ftp/users");

        return \is_array($response->decoded) ? FtpUsersFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Creates a new FTP user for a given website
     *
     * Endpoint for creating a new FTP user. NOTE: user.account well get appended with website's primary domain. i.e. `username` will become `username@domain.com`
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/ftp/createFtpUser
     * POST /orgs/{org_id}/websites/{website_id}/ftp/users
     *
     * @param string $websiteId The id of the website.
     * @param NewFtpUser $newFtpUser FTP User
     * @param bool|null $createHome If set to true we will try to crete a new home_dir for the user if does not exist.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createFtpUser(
        string $websiteId,
        NewFtpUser $newFtpUser,
        ?bool $createHome = null,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $query = [
            'createHome' => $createHome,
        ];
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/ftp/users", $query, $newFtpUser);

        return \is_array($response->decoded) ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Update given FTP user
     *
     * Endpoint for updating FTP user for a given website We only allow user's homeDir and password to be updated.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/ftp/updateFtpUser
     * PATCH /orgs/{org_id}/websites/{website_id}/ftp/users/{username}
     *
     * @param string $websiteId The id of the website.
     * @param string $username
     * @param FtpUserUpdate $ftpUserUpdate FTP User
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateFtpUser(
        string $websiteId,
        string $username,
        FtpUserUpdate $ftpUserUpdate,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/ftp/users/{$username}", [], $ftpUserUpdate);

        return $response->isSuccess;
    }

    /**
     * Deletes given FTP user
     *
     * Endpoint for deleting FTP user for a given website. User homeDir can only be deleted if it is a subdir for the website home.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/ftp/deleteFtpUser
     * DELETE /orgs/{org_id}/websites/{website_id}/ftp/users/{username}
     *
     * @param string $websiteId The id of the website.
     * @param string $username
     * @param bool|null $deleteHome If set to true we will try to delete the homeDir for the user. User homeDir can only be deleted if it is a subdir for the website home.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteFtpUser(
        string $websiteId,
        string $username,
        ?bool $deleteHome = null,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $query = [
            'deleteHome' => $deleteHome,
        ];
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/ftp/users/{$username}", $query);

        return $response->isSuccess;
    }
}
