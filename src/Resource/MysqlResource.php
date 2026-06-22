<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\MySQLDBsFullListing;
use GoSuccess\Enhance\DTO\MySQLUserAccessHosts;
use GoSuccess\Enhance\DTO\MySQLUserGrants;
use GoSuccess\Enhance\DTO\MySQLUsersFullListing;
use GoSuccess\Enhance\DTO\MySQLUserUpdate;
use GoSuccess\Enhance\DTO\NewMySQLDB;
use GoSuccess\Enhance\DTO\NewMySQLUser;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "mysql" section of the Enhance API.
 */
final class MysqlResource extends AbstractResource
{
    /**
     * Get website MySQL databases
     *
     * Returns all MySQL databases belonging to the given website.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/getWebsiteMySQLDBs
     * GET /orgs/{org_id}/websites/{website_id}/mysql-dbs
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MySQLDBsFullListing|null
     */
    public function getWebsiteMySQLDBs(string $websiteId, ?string $orgId = null): ?MySQLDBsFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/mysql-dbs");

        return $response->decoded !== null ? MySQLDBsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create a MySQL database for website
     *
     * Creates a new MySQL database for the given website.
     * The supplied name must conform to the following regular expression: `^[0-9a-z$_]+$`. That is, a name may only contain alphanumerical characters, dollar signs, and underscores.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/createWebsiteMySQLDB
     * POST /orgs/{org_id}/websites/{website_id}/mysql-dbs
     *
     * @param string $websiteId The id of the website.
     * @param NewMySQLDB $newMySQLDB New database details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createWebsiteMySQLDB(string $websiteId, NewMySQLDB $newMySQLDB, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/mysql-dbs", [], $newMySQLDB);

        return $response->isSuccess;
    }

    /**
     * Delete website MySQL database
     *
     * Delete website's MySQL database.
     * NOTE: All data will be lost after this endpoint returns.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/deleteWebsiteMySQLDB
     * DELETE /orgs/{org_id}/websites/{website_id}/mysql-dbs/{db_name}
     *
     * @param string $websiteId The id of the website.
     * @param string $dbName The name of the database.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteMySQLDB(string $websiteId, string $dbName, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/mysql-dbs/{$dbName}");

        return $response->isSuccess;
    }

    /**
     * Get phpMyAdmin SSO URL
     *
     * Fetches a single sign-on URL to access phpMyAdmin for this database without the need to log in.
     *
     * @link https://apidocs.enhance.com/#/mysql/getPhpMyAdminSSOUrl
     * GET /orgs/{org_id}/websites/{website_id}/mysql-dbs/{db_name}/sso
     *
     * @param string $websiteId The id of the website.
     * @param string $dbName The name of the database.
     * @param bool|null $shouldRedirect If set to true, the endpoint will send a 307 redirect to the SSO URL.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getPhpMyAdminSSOUrl(
        string $websiteId,
        string $dbName,
        ?bool $shouldRedirect = null,
        ?string $orgId = null,
    ): ?string {
        $orgId = $this->orgId($orgId);
        $query = [
            'shouldRedirect' => $shouldRedirect,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/mysql-dbs/{$dbName}/sso", $query);

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Uploads sql file and executes it against db
     *
     * Uploads an sql file which is then executed against given db. Allowed file types are '.sql', '.gz' and '.zip'. The gzip-ed file must be a valid sql. The zip archive may contain only one '.sql' file, however the file can be within a directory.
     * If the force flag is set to true (default is false), the SQL execution will not stop when an error is raised (corresponds to the --force option of mysql cli).
     * The max allowed size is 500 MB.
     *
     * @link https://apidocs.enhance.com/#/mysql/uploadSql
     * POST /v2/websites/{websiteId}/mysql/{db_id}/sql
     *
     * @param string $websiteId
     * @param string $dbId
     * @param array<string, mixed> $formData Multipart form fields.
     * @param bool|null $force
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function uploadSql(string $websiteId, string $dbId, ?array $formData = null, ?bool $force = null): bool
    {
        $query = [
            'force' => $force,
        ];
        $response = $this->client->request(HttpMethod::POST, "/v2/websites/{$websiteId}/mysql/{$dbId}/sql", $query, $formData, 'multipart/form-data');

        return $response->isSuccess;
    }

    /**
     * Takes a backup of given database and returns it gziped
     *
     * Performs a database backup into an sql, gzips the sql and returns the file system path for subsequent download with filerd.
     *
     * @link https://apidocs.enhance.com/#/mysql/downloadSql
     * GET /orgs/{org_id}/websites/{website_id}/mysql-dbs/{db_name}/sql
     *
     * @param string $websiteId The id of the website.
     * @param string $dbName The name of the database.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function downloadSql(string $websiteId, string $dbName, ?string $orgId = null): ?string
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/mysql-dbs/{$dbName}/sql");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Get website MySQL database users
     *
     * Returns all MySQL users belonging to the given website database.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/getWebsiteMySQLUsers
     * GET /orgs/{org_id}/websites/{website_id}/mysql-users
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MySQLUsersFullListing|null
     */
    public function getWebsiteMySQLUsers(string $websiteId, ?string $orgId = null): ?MySQLUsersFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/mysql-users");

        return $response->decoded !== null ? MySQLUsersFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create website MySQL database user
     *
     * Creates a new MySQL database user for the given website database.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/createWebsiteMySQLUser
     * POST /orgs/{org_id}/websites/{website_id}/mysql-users
     *
     * @param string $websiteId The id of the website.
     * @param NewMySQLUser $newMySQLUser New user details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createWebsiteMySQLUser(string $websiteId, NewMySQLUser $newMySQLUser, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/mysql-users", [], $newMySQLUser);

        return $response->isSuccess;
    }

    /**
     * Update website MySQL database user
     *
     * Updates website's MySQL database user's password (username update coming later).
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/updateWebsiteMySQLUser
     * PUT /orgs/{org_id}/websites/{website_id}/mysql-users/{username}
     *
     * @param string $websiteId The id of the website.
     * @param string $username The user of the database user.
     * @param MySQLUserUpdate $mySQLUserUpdate User update details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsiteMySQLUser(
        string $websiteId,
        string $username,
        MySQLUserUpdate $mySQLUserUpdate,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/mysql-users/{$username}", [], $mySQLUserUpdate);

        return $response->isSuccess;
    }

    /**
     * Delete website MySQL database user
     *
     * Delete website's MySQL database.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/deleteWebsiteMySQLUser
     * DELETE /orgs/{org_id}/websites/{website_id}/mysql-users/{username}
     *
     * @param string $websiteId The id of the website.
     * @param string $username The user of the database user.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteMySQLUser(string $websiteId, string $username, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/mysql-users/{$username}");

        return $response->isSuccess;
    }

    /**
     * Create website MySQL database user privileges
     *
     * Sets the privileges for a user on a given MySQL database.  This will override their current privileges.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/setWebsiteMySQLUserPrivileges
     * PUT /orgs/{org_id}/websites/{website_id}/mysql-users/{username}/privileges
     *
     * @param string $websiteId The id of the website.
     * @param string $username The user of the database user.
     * @param MySQLUserGrants $mySQLUserGrants User privilege grants.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteMySQLUserPrivileges(
        string $websiteId,
        string $username,
        MySQLUserGrants $mySQLUserGrants,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/mysql-users/{$username}/privileges", [], $mySQLUserGrants);

        return $response->isSuccess;
    }

    /**
     * Create website MySQL database user access hosts
     *
     * Adds for the given user new access hosts to website's MySQL database.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/createWebsiteMySQLUserAccessHosts
     * POST /orgs/{org_id}/websites/{website_id}/mysql-users/{username}/access-hosts
     *
     * @param string $websiteId The id of the website.
     * @param string $username The user of the database user.
     * @param MySQLUserAccessHosts $mySQLUserAccessHosts User access hosts.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createWebsiteMySQLUserAccessHosts(
        string $websiteId,
        string $username,
        MySQLUserAccessHosts $mySQLUserAccessHosts,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/mysql-users/{$username}/access-hosts", [], $mySQLUserAccessHosts);

        return $response->isSuccess;
    }

    /**
     * Delete website MySQL database user access hosts
     *
     * Removes from the given user access hosts to website's MySQL database.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/mysql/deleteWebsiteMySQLUserAccessHosts
     * DELETE /orgs/{org_id}/websites/{website_id}/mysql-users/{username}/access-hosts
     *
     * @param string $websiteId The id of the website.
     * @param string $username The user of the database user.
     * @param MySQLUserAccessHosts $mySQLUserAccessHosts User access hosts.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteMySQLUserAccessHosts(
        string $websiteId,
        string $username,
        MySQLUserAccessHosts $mySQLUserAccessHosts,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/mysql-users/{$username}/access-hosts", [], $mySQLUserAccessHosts);

        return $response->isSuccess;
    }
}
