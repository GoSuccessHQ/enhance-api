<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\MySQLDBsFullListing;
use GoSuccess\Enhance\DTO\NewMySQLDB;
use GoSuccess\Enhance\DTO\NewPostgresqlUser;
use GoSuccess\Enhance\DTO\PostgresqlUsersFullListing;
use GoSuccess\Enhance\DTO\PostgresqlUserUpdate;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "postgresql" section of the Enhance API.
 */
final class PostgresqlResource extends AbstractResource
{
    /**
     * Get website PostgreSQL databases
     *
     * Returns all PostgreSQL databases belonging to the given website.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/postgresql/getWebsitePostgresqlDbs
     * GET /orgs/{org_id}/websites/{website_id}/postgresql-dbs
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MySQLDBsFullListing|null
     */
    public function getWebsitePostgresqlDbs(string $websiteId, ?string $orgId = null): ?MySQLDBsFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/postgresql-dbs");

        return $response->decoded !== null ? MySQLDBsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create a PostgreSQL database for website
     *
     * Creates a new PostgreSQL database for the given website.
     * The supplied name must conform to the following regular expression: `^[0-9a-z$_]+$`. That is, a name may only contain alphanumerical characters, dollar signs, and underscores.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/postgresql/createWebsitePostgresqlDb
     * POST /orgs/{org_id}/websites/{website_id}/postgresql-dbs
     *
     * @param string $websiteId The id of the website.
     * @param NewMySQLDB $newMySQLDB New database details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createWebsitePostgresqlDb(string $websiteId, NewMySQLDB $newMySQLDB, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/postgresql-dbs", [], $newMySQLDB);

        return $response->isSuccess;
    }

    /**
     * Delete website PostgreSQL database
     *
     * Delete website's PostgreSQL database.
     * NOTE: All data will be lost after this endpoint returns.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/postgresql/deleteWebsitePostgresqlDb
     * DELETE /orgs/{org_id}/websites/{website_id}/postgresql-dbs/{db_name}
     *
     * @param string $websiteId The id of the website.
     * @param string $dbName The name of the database.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsitePostgresqlDb(string $websiteId, string $dbName, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/postgresql-dbs/{$dbName}");

        return $response->isSuccess;
    }

    /**
     * Get website PostgreSQL database users
     *
     * Returns all PostgreSQL users belonging to the given website database.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/postgresql/getWebsitePostgresqlUsers
     * GET /orgs/{org_id}/websites/{website_id}/postgresql-users
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return PostgresqlUsersFullListing|null
     */
    public function getWebsitePostgresqlUsers(string $websiteId, ?string $orgId = null): ?PostgresqlUsersFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/postgresql-users");

        return $response->decoded !== null ? PostgresqlUsersFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create website PostgreSQL database user
     *
     * Creates a new MySQL database user for the given website database.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/postgresql/createWebsitePostgresqlUser
     * POST /orgs/{org_id}/websites/{website_id}/postgresql-users
     *
     * @param string $websiteId The id of the website.
     * @param NewPostgresqlUser $newPostgresqlUser New user details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createWebsitePostgresqlUser(
        string $websiteId,
        NewPostgresqlUser $newPostgresqlUser,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/postgresql-users", [], $newPostgresqlUser);

        return $response->isSuccess;
    }

    /**
     * Update website PostgreSQL database user
     *
     * Updates website's PostgreSQL database user's password (username update coming later).
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/postgresql/updateWebsitePostgresqlUser
     * PATCH /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}
     *
     * @param string $websiteId The id of the website.
     * @param string $username The user of the database user.
     * @param PostgresqlUserUpdate $postgresqlUserUpdate User update details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsitePostgresqlUser(
        string $websiteId,
        string $username,
        PostgresqlUserUpdate $postgresqlUserUpdate,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/postgresql-users/{$username}", [], $postgresqlUserUpdate);

        return $response->isSuccess;
    }

    /**
     * Delete website PostgreSQL database user
     *
     * Delete website's PostgreSQL database user.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/postgresql/deleteWebsitePostgresqlUser
     * DELETE /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}
     *
     * @param string $websiteId The id of the website.
     * @param string $username The user of the database user.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsitePostgresqlUser(string $websiteId, string $username, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/postgresql-users/{$username}");

        return $response->isSuccess;
    }

    /**
     * Grant privileges on a specific database
     *
     * This will grant the Postgresql user full super admin privileges on the given database.
     *
     * @link https://apidocs.enhance.com/#/postgresql/grantPostgresqlUserDbPrivileges
     * POST /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}/privileges
     *
     * @param string $websiteId The id of the website.
     * @param string $username The user of the database user.
     * @param string $value Database name
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function grantPostgresqlUserDbPrivileges(
        string $websiteId,
        string $username,
        ?string $value,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/postgresql-users/{$username}/privileges", [], $value);

        return $response->isSuccess;
    }

    /**
     * Remove privileges on this database
     *
     * @link https://apidocs.enhance.com/#/postgresql/revokePostgresqlUserDbPrivileges
     * DELETE /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}/privileges/{db_name}
     *
     * @param string $websiteId The id of the website.
     * @param string $username The user of the database user.
     * @param string $dbName The name of the database.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function revokePostgresqlUserDbPrivileges(
        string $websiteId,
        string $username,
        string $dbName,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/postgresql-users/{$username}/privileges/{$dbName}");

        return $response->isSuccess;
    }
}
