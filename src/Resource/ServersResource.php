<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\EmailServerHostnameOverride;
use GoSuccess\Enhance\DTO\HttpdStatus;
use GoSuccess\Enhance\DTO\InstallCmd;
use GoSuccess\Enhance\DTO\ModSecStatus;
use GoSuccess\Enhance\DTO\NewBackupRole;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\NewServerGroup;
use GoSuccess\Enhance\DTO\NewServerIp;
use GoSuccess\Enhance\DTO\OutboundSpamScanningSettings;
use GoSuccess\Enhance\DTO\OwaspVersion;
use GoSuccess\Enhance\DTO\PhpIni;
use GoSuccess\Enhance\DTO\RolesInfo;
use GoSuccess\Enhance\DTO\ScreenshotConfig;
use GoSuccess\Enhance\DTO\ScreenshotConfigUpdate;
use GoSuccess\Enhance\DTO\ServerConf;
use GoSuccess\Enhance\DTO\ServerDiskUsage;
use GoSuccess\Enhance\DTO\ServerGroups;
use GoSuccess\Enhance\DTO\ServerGroupUpdate;
use GoSuccess\Enhance\DTO\ServerHostnameWebsite;
use GoSuccess\Enhance\DTO\ServerInfo;
use GoSuccess\Enhance\DTO\ServerIowait;
use GoSuccess\Enhance\DTO\ServerLoad;
use GoSuccess\Enhance\DTO\ServerMemoryUsage;
use GoSuccess\Enhance\DTO\ServerNetworkInterfaces;
use GoSuccess\Enhance\DTO\ServerNetworkStats;
use GoSuccess\Enhance\DTO\ServersListing;
use GoSuccess\Enhance\DTO\ServerSpecs;
use GoSuccess\Enhance\DTO\ServerStatsFullListing;
use GoSuccess\Enhance\DTO\ServerStatus;
use GoSuccess\Enhance\DTO\ServerUptime;
use GoSuccess\Enhance\DTO\SetServerStatus;
use GoSuccess\Enhance\DTO\SetWebserverKind;
use GoSuccess\Enhance\DTO\SlaveRegistration;
use GoSuccess\Enhance\DTO\SystemPackage;
use GoSuccess\Enhance\DTO\UpgradableSystemPackage;
use GoSuccess\Enhance\DTO\ValidationResult;
use GoSuccess\Enhance\DTO\WebsiteAndDomainUuid;
use GoSuccess\Enhance\DTO\WebsitePhpSettings;
use GoSuccess\Enhance\Enum\FsQuotaStatus;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Enum\MysqlKind;
use GoSuccess\Enhance\Enum\Outcome;
use GoSuccess\Enhance\Enum\ServerRole;
use GoSuccess\Enhance\Enum\SettingKind;
use GoSuccess\Enhance\Enum\SystemPackageName;
use GoSuccess\Enhance\Enum\WebserverKind;

/**
 * Operations for the "servers" section of the Enhance API.
 */
final class ServersResource extends AbstractResource
{
    /**
     * Reflect back the IP of the API consumer
     *
     * @link https://apidocs.enhance.com/#/servers/getClientIp
     * GET /client_ip
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getClientIp(): ?string
    {
        $response = $this->client->request(HttpMethod::GET, '/client_ip');

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Create a slave node
     *
     * This endpoint is called by the slave server installation script and not by the API. Only included for completeness.
     *
     * @link https://apidocs.enhance.com/#/servers/createSlave
     * POST /servers/slaves
     *
     * @param SlaveRegistration $slaveRegistration
     * @param string|null $key The secret registration key
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createSlave(SlaveRegistration $slaveRegistration, ?string $key = null): bool
    {
        $query = [
            'key' => $key,
        ];
        $response = $this->client->request(HttpMethod::POST, '/servers/slaves', $query, $slaveRegistration);

        return $response->isSuccess;
    }

    /**
     * Get installed servers
     *
     * Returns a list of all servers in this Enhance cluster (including the master server and all slaves).
     * The result set of servers may optionally be sorted, paginated, as well as grouped by a server's group id. If not grouped, the returned items are a flat list of server resource objects, whereas if grouped, the returned items are an object (map) of list of servers mapped to their group ids.
     * Grouping is applied after pagination and sorting, and in the latter case the servers within one group will be sorted. Therefore, if paginated, the last group in items, i.e. the group on the "border", may not contain all servers belonging to that group if the given limit was such as would be exceeded if all its servers were included. In such a case, the remaining servers of the group are returned in the next batch.
     * Example: Assume servers server1, server2, server3, server4, server5 and groups group1, group2, where group1 contains server1 and group2 contains server2, server3, and server4 is not in a group. If the request specifies an offset of 0 and a limit of 2, then the returned structure may be as follows: ```json {
     *     items: {
     *         group1_id: [
     *             server1,
     *         ],
     *         group2_id: [
     *             server2,
     *         ],
     *     },
     *     total: 4
     * } ``` Then, in the next request, if offset is changed to 2, the returned items may be: ```json {
     *     items: {
     *         group2_id: [
     *             server3,
     *         ],
     *         "ungrouped": [
     *             server4
     *         ],
     *     },
     *     total: 4
     * } ``` Containing the rest of group2's servers as well as the ungrouped servers.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServers
     * GET /servers
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $sortBy The field by which to sort.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServersListing|null
     */
    public function getServers(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortOrder = null,
        ?string $sortBy = null,
    ): ?ServersListing {
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortOrder' => $sortOrder,
            'sortBy' => $sortBy,
        ];
        $response = $this->client->request(HttpMethod::GET, '/servers', $query);

        return $response->decoded !== null ? ServersListing::fromArray($response->decoded) : null;
    }

    /**
     * Get server info
     *
     * Returns info about the selected server, if it exists.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerInfo
     * GET /servers/{server_id}
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerInfo|null
     */
    public function getServerInfo(?string $serverId): ?ServerInfo
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}");

        return $response->decoded !== null ? ServerInfo::fromArray($response->decoded) : null;
    }

    /**
     * Configure a server
     *
     * Configures a server with roles to enable or disable, a friendly name to give (for identification purposes), and/or to assign server to a group.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/configureServer
     * PATCH /servers/{server_id}
     *
     * @param string $serverId The UUID of the server
     * @param ServerConf $serverConf
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function configureServer(?string $serverId, ServerConf $serverConf): bool
    {
        $response = $this->client->request(HttpMethod::PATCH, "/servers/{$serverId}", [], $serverConf);

        return $response->isSuccess;
    }

    /**
     * Delete a (slave) server
     *
     * Removes a given server from the Enhance cluster.
     * The server to be removed may only be a slave server as the master server cannot be removed (the error code `invalid_argument` is returned in such a case). Moreover, the server cannot be deleted if it has any data (such as running/suspended website, emails, etc) on it.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/deleteSlave
     * DELETE /servers/{server_id}
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteSlave(?string $serverId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/servers/{$serverId}");

        return $response->isSuccess;
    }

    /**
     * Get server specs
     *
     * Returns the spec of a given server ID.  Endpoint accessible to master organisation and to an end user or reseller who has a dedicated subscription to this server.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerSpecs
     * GET /servers/{server_id}/specs
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerSpecs|null
     */
    public function getServerSpecs(?string $serverId): ?ServerSpecs
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/specs");

        return $response->decoded !== null ? ServerSpecs::fromArray($response->decoded) : null;
    }

    /**
     * Get the version of the running appcd
     *
     * Returns the version of the running appcd instance on this server.
     *
     * @link https://apidocs.enhance.com/#/servers/getAppcdVersion
     * GET /servers/{server_id}/appcd/version
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getAppcdVersion(?string $serverId): ?string
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/appcd/version");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Check if Roundcube SSO is enabled on this server
     *
     * @link https://apidocs.enhance.com/#/servers/getRoundcubeSsoEnabled
     * GET /servers/{server_id}/roundcube_sso_enabled
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool|null
     */
    public function getRoundcubeSsoEnabled(?string $serverId): ?bool
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/roundcube_sso_enabled");

        return $response->decoded === null ? null : (bool)$response->decoded;
    }

    /**
     * Set Roundcube SSO enabled state
     *
     * @link https://apidocs.enhance.com/#/servers/setRoundcubeSsoEnabled
     * PUT /servers/{server_id}/roundcube_sso_enabled
     *
     * @param string $serverId The UUID of the server
     * @param bool $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setRoundcubeSsoEnabled(?string $serverId, ?bool $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/roundcube_sso_enabled", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get the screenshot config of the running appcd
     *
     * Returns the screenshot config of the running appcd instance on this server.
     *
     * @link https://apidocs.enhance.com/#/servers/getAppcdScreenshotConfig
     * GET /servers/{server_id}/appcd/screenshot/config
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ScreenshotConfig|null
     */
    public function getAppcdScreenshotConfig(?string $serverId): ?ScreenshotConfig
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/appcd/screenshot/config");

        return $response->decoded !== null ? ScreenshotConfig::fromArray($response->decoded) : null;
    }

    /**
     * Update the screenshot config of the running appcd
     *
     * Update the screenshot config of the running appcd instance on this server.
     *
     * @link https://apidocs.enhance.com/#/servers/updateAppcdScreenshotConfig
     * PATCH /servers/{server_id}/appcd/screenshot/config
     *
     * @param string $serverId The UUID of the server
     * @param ScreenshotConfigUpdate $screenshotConfigUpdate
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateAppcdScreenshotConfig(
        ?string $serverId,
        ScreenshotConfigUpdate $screenshotConfigUpdate,
    ): bool {
        $response = $this->client->request(HttpMethod::PATCH, "/servers/{$serverId}/appcd/screenshot/config", [], $screenshotConfigUpdate);

        return $response->isSuccess;
    }

    /**
     * Get domains which are mapped to a server
     *
     * Returns the server hostname website for this server
     *
     * @link https://apidocs.enhance.com/#/servers/getServerHostnameWebsite
     * GET /servers/{server_id}/domains
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerHostnameWebsite|null
     */
    public function getServerHostnameWebsite(?string $serverId): ?ServerHostnameWebsite
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/domains");

        return $response->decoded !== null ? ServerHostnameWebsite::fromArray($response->decoded) : null;
    }

    /**
     * Create a domain which is mapped to a server
     *
     * Maps a hostname to a server by creating a special kind of website with kind `ServerHostname`.  This can be used for POP/IMAP/SMTP as well as HTTP. LetsEncrypt certificates will be issued if the DNS resolves.  Only one server hostname website will be created, additional domains will be added as aliases.
     *
     * @link https://apidocs.enhance.com/#/servers/createServerDomain
     * POST /servers/{server_id}/domains
     *
     * @param string $serverId The UUID of the server
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsiteAndDomainUuid|null
     */
    public function createServerDomain(?string $serverId, ?string $value): ?WebsiteAndDomainUuid
    {
        $response = $this->client->request(HttpMethod::POST, "/servers/{$serverId}/domains", [], $value);

        return $response->decoded !== null ? WebsiteAndDomainUuid::fromArray($response->decoded) : null;
    }

    /**
     * Delete a mapped server domain
     *
     * Deletes a server domain mapping and the domain itself.  Does not delete associated SSLs.
     *
     * @link https://apidocs.enhance.com/#/servers/deleteServerDomain
     * DELETE /servers/{server_id}/domains/{domain_id}
     *
     * @param string $serverId The UUID of the server
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteServerDomain(?string $serverId, ?string $domainId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/servers/{$serverId}/domains/{$domainId}");

        return $response->isSuccess;
    }

    /**
     * Updates the primary IP of the server in the database and in-memory metadata. This operation will not affect the IP used for service communication until the next restart of orchd. The new IP will be used for creation of new resources such as websites on this server but existing websites will not have their IP changed.
     *
     * @link https://apidocs.enhance.com/#/servers/updateServerPrimaryIp
     * PUT /servers/{server_id}/primary-ip
     *
     * @param string $serverId The UUID of the server
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateServerPrimaryIp(?string $serverId, ?string $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/primary-ip", [], $value);

        return $response->isSuccess;
    }

    /**
     * Updates or sets the primary ipv6 address of the server. This endpoint will not change existing websites' DNS but the new record will be applied to all future zones.
     *
     * @link https://apidocs.enhance.com/#/servers/updateServerPrimaryIpv6
     * PUT /v2/servers/{server_id}/primary-ipv6
     *
     * @param string $serverId The UUID of the server
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateServerPrimaryIpv6(?string $serverId, ?string $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/servers/{$serverId}/primary-ipv6", [], $value);

        return $response->isSuccess;
    }

    /**
     * Deletes/unsets the primary IPv6 address for a server.
     *
     * @link https://apidocs.enhance.com/#/servers/deleteServerPrimaryIpv6
     * DELETE /v2/servers/{server_id}/primary-ipv6
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteServerPrimaryIpv6(?string $serverId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/v2/servers/{$serverId}/primary-ipv6");

        return $response->isSuccess;
    }

    /**
     * Gets the MySQL kind for a given server.
     *
     * @link https://apidocs.enhance.com/#/servers/getDatabaseRoleMysqlKind
     * GET /v2/servers/{server_id}/database-role
     *
     * @param string $serverId The UUID of the server
     * @param MysqlKind|null $mysqlKind
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MysqlKind|null
     */
    public function getDatabaseRoleMysqlKind(?string $serverId, ?MysqlKind $mysqlKind = null): ?MysqlKind
    {
        $query = [
            'mysqlKind' => $mysqlKind,
        ];
        $response = $this->client->request(HttpMethod::GET, "/v2/servers/{$serverId}/database-role", $query);

        return \is_string($response->decoded) || \is_int($response->decoded) ? MysqlKind::tryFrom($response->decoded) : null;
    }

    /**
     * Enables the database role on a given ServerUuid
     *
     * @link https://apidocs.enhance.com/#/servers/installDatabaseRole
     * PUT /v2/servers/{server_id}/database-role
     *
     * @param string $serverId The UUID of the server
     * @param MysqlKind|null $mysqlKind
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function installDatabaseRole(?string $serverId, ?MysqlKind $mysqlKind = null): bool
    {
        $query = [
            'mysqlKind' => $mysqlKind,
        ];
        $response = $this->client->request(HttpMethod::PUT, "/v2/servers/{$serverId}/database-role", $query);

        return $response->isSuccess;
    }

    /**
     * Restart MySQL gracefully
     *
     * @link https://apidocs.enhance.com/#/servers/restartMysql
     * POST /v2/servers/{server_id}/database-role/restart
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function restartMysql(?string $serverId): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/v2/servers/{$serverId}/database-role/restart");

        return $response->isSuccess;
    }

    /**
     * Download my.cnf for a given server
     *
     * @link https://apidocs.enhance.com/#/servers/getMysqlMyCnf
     * GET /v2/servers/{server_id}/my-cnf
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getMysqlMyCnf(?string $serverId): ?string
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/servers/{$serverId}/my-cnf");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Save a new my.cnf
     *
     * @link https://apidocs.enhance.com/#/servers/saveMysqlMyCnf
     * PUT /v2/servers/{server_id}/my-cnf
     *
     * @param string $serverId The UUID of the server
     * @param string $value New my.cnf to be applied
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function saveMysqlMyCnf(?string $serverId, ?string $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/servers/{$serverId}/my-cnf", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get DNS pool IPs
     *
     * @link https://apidocs.enhance.com/#/servers/getDnsPoolIps
     * GET /v2/servers/dns_pool
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function getDnsPoolIps(): array
    {
        $response = $this->client->request(HttpMethod::GET, '/v2/servers/dns_pool');

        return (array)($response->decoded ?? []);
    }

    /**
     * Delete server from group
     *
     * Deletes a server from the server group it is in, if any.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/deleteServerFromGroup
     * DELETE /servers/{server_id}/group
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteServerFromGroup(?string $serverId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/servers/{$serverId}/group");

        return $response->isSuccess;
    }

    /**
     * Get server status
     *
     * Returns system (online or offline) status of the given server.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerStatus
     * GET /servers/{server_id}/status
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerStatus|null
     */
    public function getServerStatus(?string $serverId): ?ServerStatus
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/status");

        return $response->decoded !== null ? ServerStatus::fromArray($response->decoded) : null;
    }

    /**
     * Set the status of one server.
     *
     * Set the status of one server by rebooting it for example.
     *
     * @link https://apidocs.enhance.com/#/servers/setServerStatus
     * POST /servers/{server_id}/status
     *
     * @param string $serverId The UUID of the server
     * @param SetServerStatus $setServerStatus The action to be taken for a specific server. When rebooting a server if the reboot is graceful before the server itself is rebooted all the installed services which make use of an underlying daemon will be asked to shutdown the daemon in question (such as mysqld, httpd or pdns). If the reboot is forced the underlying daemon stop will be forced as well. Note: Primary server reboots are never allowed. The server reboot will only happens 1 minute after the request is sent.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setServerStatus(?string $serverId, SetServerStatus $setServerStatus): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/servers/{$serverId}/status", [], $setServerStatus);

        return $response->isSuccess;
    }

    /**
     * Set server to decommissioned
     *
     * If a server was decommissioned outside of Enhance, set its status to decommissioned.  This will remove the server from any status checks, will prevent website placement and will enable websites to be moved from it to another server using backups if available.
     *
     * @link https://apidocs.enhance.com/#/servers/setServerDecommissioned
     * PUT /servers/{server_id}/decommissioned
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setServerDecommissioned(?string $serverId): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/decommissioned");

        return $response->isSuccess;
    }

    /**
     * Get web server
     *
     * Fetches the current web server kind for this server.
     *
     * @link https://apidocs.enhance.com/#/servers/getWebserverKind
     * GET /servers/{server_id}/webserver
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebserverKind|null
     */
    public function getWebserverKind(?string $serverId): ?WebserverKind
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/webserver");

        return \is_string($response->decoded) || \is_int($response->decoded) ? WebserverKind::tryFrom($response->decoded) : null;
    }

    /**
     * Set the web server kind for one server.
     *
     * Changes the web server kind for this server.  This will rebuild any application containers if required.  It may be a long running operation.
     *
     * @link https://apidocs.enhance.com/#/servers/setWebserverKind
     * PUT /servers/{server_id}/webserver
     *
     * @param string $serverId The UUID of the server
     * @param SetWebserverKind $setWebserverKind
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebserverKind(?string $serverId, SetWebserverKind $setWebserverKind): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/webserver", [], $setWebserverKind);

        return $response->isSuccess;
    }

    /**
     * Reset the config for the web server to default.
     *
     * Will reset the config for the running web server to "known good" defaults.  Currently only available for LiteSpeed.
     *
     * @link https://apidocs.enhance.com/#/servers/resetWebServerConfig
     * POST /servers/{server_id}/webserver/config/reset
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function resetWebServerConfig(?string $serverId): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/servers/{$serverId}/webserver/config/reset");

        return $response->isSuccess;
    }

    /**
     * Set a new LiteSpeed admin password.
     *
     * Will reset the LiteSpeed or OpenLiteSpeed admin password.  The username is always "admin".
     *
     * @link https://apidocs.enhance.com/#/servers/setLiteSpeedAdminPassword
     * POST /servers/{server_id}/webserver/litespeed/password
     *
     * @param string $serverId The UUID of the server
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setLiteSpeedAdminPassword(?string $serverId, ?string $value): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/servers/{$serverId}/webserver/litespeed/password", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get the IP whitelist
     *
     * @link https://apidocs.enhance.com/#/servers/getSpamIpWhitelist
     * GET /servers/{server_id}/spam/ip_whitelist
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function getSpamIpWhitelist(?string $serverId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/spam/ip_whitelist");

        return (array)($response->decoded ?? []);
    }

    /**
     * Add to the IP whitelist
     *
     * @link https://apidocs.enhance.com/#/servers/addSpamIpWhitelist
     * POST /servers/{server_id}/spam/ip_whitelist
     *
     * @param string $serverId The UUID of the server
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function addSpamIpWhitelist(?string $serverId, ?string $value = null): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/servers/{$serverId}/spam/ip_whitelist", [], $value);

        return $response->isSuccess;
    }

    /**
     * Delete from the IP whitelist
     *
     * @link https://apidocs.enhance.com/#/servers/deleteFromSpamIpWhitelist
     * DELETE /servers/{server_id}/spam/ip_whitelist
     *
     * @param string $serverId The UUID of the server
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteFromSpamIpWhitelist(?string $serverId, ?string $value = null): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/servers/{$serverId}/spam/ip_whitelist", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get the hourly SMTP rate limit
     *
     * @link https://apidocs.enhance.com/#/servers/getSmtpRateLimitHourly
     * GET /servers/{server_id}/spam/smtp_rate_limit_hourly
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return float|null
     */
    public function getSmtpRateLimitHourly(?string $serverId): ?float
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/spam/smtp_rate_limit_hourly");

        return $response->decoded === null ? null : (float)$response->decoded;
    }

    /**
     * Set the hourly SMTP rate limit
     *
     * @link https://apidocs.enhance.com/#/servers/setSmtpRateLimitHourly
     * PUT /servers/{server_id}/spam/smtp_rate_limit_hourly
     *
     * @param string $serverId The UUID of the server
     * @param float $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setSmtpRateLimitHourly(?string $serverId, ?float $value = null): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/spam/smtp_rate_limit_hourly", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get the hourly website generated email rate limit
     *
     * @link https://apidocs.enhance.com/#/servers/getWebsiteGeneratedRateLimitHourly
     * GET /servers/{server_id}/spam/website_generated_rate_limit_hourly
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return float|null
     */
    public function getWebsiteGeneratedRateLimitHourly(?string $serverId): ?float
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/spam/website_generated_rate_limit_hourly");

        return $response->decoded === null ? null : (float)$response->decoded;
    }

    /**
     * Set the hourly SMTP rate limit
     *
     * @link https://apidocs.enhance.com/#/servers/setWebsiteGeneratedRateLimitHourly
     * PUT /servers/{server_id}/spam/website_generated_rate_limit_hourly
     *
     * @param string $serverId The UUID of the server
     * @param float $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteGeneratedRateLimitHourly(?string $serverId, ?float $value = null): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/spam/website_generated_rate_limit_hourly", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get the hostname override for the email server (postfix) if set
     *
     * If unset, this defaults to the system hostname
     *
     * @link https://apidocs.enhance.com/#/servers/getEmailServerHostnameOverride
     * GET /servers/{server_id}/email/hostname_override
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return EmailServerHostnameOverride|null
     */
    public function getEmailServerHostnameOverride(?string $serverId): ?EmailServerHostnameOverride
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/email/hostname_override");

        return $response->decoded !== null ? EmailServerHostnameOverride::fromArray($response->decoded) : null;
    }

    /**
     * Set the hostname override for the email server (postfix)
     *
     * If unset, this defaults to the system hostname
     *
     * @link https://apidocs.enhance.com/#/servers/setEmailServerHostnameOverride
     * PUT /servers/{server_id}/email/hostname_override
     *
     * @param string $serverId The UUID of the server
     * @param EmailServerHostnameOverride $emailServerHostnameOverride Hostname override or null
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setEmailServerHostnameOverride(
        ?string $serverId,
        ?EmailServerHostnameOverride $emailServerHostnameOverride = null,
    ): bool {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/email/hostname_override", [], $emailServerHostnameOverride);

        return $response->isSuccess;
    }

    /**
     * Get the status of outbound spam scanning
     *
     * @link https://apidocs.enhance.com/#/servers/getOutboundSpamScanningSettings
     * GET /servers/{server_id}/email/spam/outbound_scanning
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return OutboundSpamScanningSettings|null
     */
    public function getOutboundSpamScanningSettings(?string $serverId): ?OutboundSpamScanningSettings
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/email/spam/outbound_scanning");

        return $response->decoded !== null ? OutboundSpamScanningSettings::fromArray($response->decoded) : null;
    }

    /**
     * Set the settings for outbound spam scanning
     *
     * @link https://apidocs.enhance.com/#/servers/setOutboundSpamScanningSettings
     * PUT /servers/{server_id}/email/spam/outbound_scanning
     *
     * @param string $serverId The UUID of the server
     * @param OutboundSpamScanningSettings $outboundSpamScanningSettings Outbound spam settings
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setOutboundSpamScanningSettings(
        ?string $serverId,
        ?OutboundSpamScanningSettings $outboundSpamScanningSettings = null,
    ): bool {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/email/spam/outbound_scanning", [], $outboundSpamScanningSettings);

        return $response->isSuccess;
    }

    /**
     * Get mod security status for a server
     *
     * @link https://apidocs.enhance.com/#/servers/getServerModSecurityStatus
     * GET /v2/servers/{server_id}/modsec_status
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ModSecStatus|null
     */
    public function getServerModSecurityStatus(?string $serverId): ?ModSecStatus
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/servers/{$serverId}/modsec_status");

        return $response->decoded !== null ? ModSecStatus::fromArray($response->decoded) : null;
    }

    /**
     * Set mod security status for a server
     *
     * If enabled, all websites on this server by default will have mod security enabled, unless explicitly disabled.
     *
     * @link https://apidocs.enhance.com/#/servers/setServerModSecurityStatus
     * PUT /v2/servers/{server_id}/modsec_status
     *
     * @param string $serverId The UUID of the server
     * @param ModSecStatus $modSecStatus
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setServerModSecurityStatus(?string $serverId, ModSecStatus $modSecStatus): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/servers/{$serverId}/modsec_status", [], $modSecStatus);

        return $response->isSuccess;
    }

    /**
     * Get the current and available version of the OWASP rules
     *
     * @link https://apidocs.enhance.com/#/servers/getOwaspRulesVersion
     * GET /v2/servers/{server_id}/owasp
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return OwaspVersion|null
     */
    public function getOwaspRulesVersion(?string $serverId): ?OwaspVersion
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/servers/{$serverId}/owasp");

        return $response->decoded !== null ? OwaspVersion::fromArray($response->decoded) : null;
    }

    /**
     * Upgrade OWASP rules
     *
     * Will update the owasp rules to the latest version.  If the current version is the latest, it will be reinstalled.
     *
     * @link https://apidocs.enhance.com/#/servers/updateOwaspRules
     * POST /v2/servers/{server_id}/owasp
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateOwaspRules(?string $serverId): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/v2/servers/{$serverId}/owasp");

        return $response->isSuccess;
    }

    /**
     * Get mod security config
     *
     * @link https://apidocs.enhance.com/#/servers/getServerModSecurityConfig
     * GET /v2/servers/{server_id}/modsec_conf
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getServerModSecurityConfig(?string $serverId): ?string
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/servers/{$serverId}/modsec_conf");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Set mod security config
     *
     * This config is included in the web server config when mod_security is enabled.
     *
     * @link https://apidocs.enhance.com/#/servers/setServerModSecurityConfig
     * PUT /v2/servers/{server_id}/modsec_conf
     *
     * @param string $serverId The UUID of the server
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setServerModSecurityConfig(?string $serverId, ?string $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/servers/{$serverId}/modsec_conf", [], $value);

        return $response->isSuccess;
    }

    /**
     * Delete custom mod_security config and reset to default
     *
     * @link https://apidocs.enhance.com/#/servers/resetServerModSecurityConfig
     * DELETE /v2/servers/{server_id}/modsec_conf
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function resetServerModSecurityConfig(?string $serverId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/v2/servers/{$serverId}/modsec_conf");

        return $response->isSuccess;
    }

    /**
     * Get Server stats
     *
     * Returns server stats between the optional start and end date. Defaults to last 24 hours.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerStats
     * GET /servers/{server_id}/historic-stats
     *
     * @param string $serverId The UUID of the server
     * @param string|null $start Start datetime UTC.
     * @param string|null $end End datetime UTC.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerStatsFullListing|null
     */
    public function getServerStats(
        ?string $serverId,
        ?string $start = null,
        ?string $end = null,
    ): ?ServerStatsFullListing {
        $query = [
            'start' => $start,
            'end' => $end,
        ];
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/historic-stats", $query);

        return $response->decoded !== null ? ServerStatsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Get whether FS quota was enabled on the server
     *
     * @link https://apidocs.enhance.com/#/servers/getFsQuotaStatus
     * GET /servers/{server_id}/fs-quota-limits
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return FsQuotaStatus|null
     */
    public function getFsQuotaStatus(?string $serverId): ?FsQuotaStatus
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/fs-quota-limits");

        return \is_string($response->decoded) || \is_int($response->decoded) ? FsQuotaStatus::tryFrom($response->decoded) : null;
    }

    /**
     * Enable FS quota limits on the server
     *
     * @link https://apidocs.enhance.com/#/servers/enableFsQuotaLimits
     * POST /servers/{server_id}/fs-quota-limits
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function enableFsQuotaLimits(?string $serverId): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/servers/{$serverId}/fs-quota-limits");

        return $response->isSuccess;
    }

    /**
     * Get server uptime in seconds
     *
     * Returns system iowait of the given server.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerUptime
     * GET /servers/{server_id}/uptime
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerUptime|null
     */
    public function getServerUptime(?string $serverId): ?ServerUptime
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/uptime");

        return $response->decoded !== null ? ServerUptime::fromArray($response->decoded) : null;
    }

    /**
     * Get server iowait
     *
     * Returns system iowait of the given server in number of elapsed seconds since power-on.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerIowait
     * GET /servers/{server_id}/iowait
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerIowait|null
     */
    public function getServerIowait(?string $serverId): ?ServerIowait
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/iowait");

        return $response->decoded !== null ? ServerIowait::fromArray($response->decoded) : null;
    }

    /**
     * Get server system load
     *
     * Returns one minute system load of the given server.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerLoad
     * GET /servers/{server_id}/load
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerLoad|null
     */
    public function getServerLoad(?string $serverId): ?ServerLoad
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/load");

        return $response->decoded !== null ? ServerLoad::fromArray($response->decoded) : null;
    }

    /**
     * Get server disk usage
     *
     * Returns disk usage of all disks on the given server.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerDiskUsage
     * GET /servers/{server_id}/disk-usage
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerDiskUsage|null
     */
    public function getServerDiskUsage(?string $serverId): ?ServerDiskUsage
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/disk-usage");

        return $response->decoded !== null ? ServerDiskUsage::fromArray($response->decoded) : null;
    }

    /**
     * Get server memory usage
     *
     * Returns RAM and swap space usage on the given server.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerMemoryUsage
     * GET /servers/{server_id}/memory-usage
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerMemoryUsage|null
     */
    public function getServerMemoryUsage(?string $serverId): ?ServerMemoryUsage
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/memory-usage");

        return $response->decoded !== null ? ServerMemoryUsage::fromArray($response->decoded) : null;
    }

    /**
     * Get server network stats
     *
     * Returns network stats of the given server.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerNetworkStats
     * GET /servers/{server_id}/network-stats
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerNetworkStats|null
     */
    public function getServerNetworkStats(?string $serverId): ?ServerNetworkStats
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/network-stats");

        return $response->decoded !== null ? ServerNetworkStats::fromArray($response->decoded) : null;
    }

    /**
     * Get server network interfaces
     *
     * Returns the network interfaces of the given server.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerNetworkInterfaces
     * GET /servers/{server_id}/interfaces
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerNetworkInterfaces|null
     */
    public function getServerNetworkInterfaces(?string $serverId): ?ServerNetworkInterfaces
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/interfaces");

        return $response->decoded !== null ? ServerNetworkInterfaces::fromArray($response->decoded) : null;
    }

    /**
     * Create server network interface secondary IP
     *
     * Creates a new secondary IP address for the server's network interface.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/createServerNetworkInterfaceIp
     * POST /servers/{server_id}/interfaces/{interface}/ips
     *
     * @param string $serverId The UUID of the server
     * @param string $interface The name of the network interface
     * @param NewServerIp $newServerIp
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createServerNetworkInterfaceIp(
        ?string $serverId,
        ?string $interface,
        NewServerIp $newServerIp,
    ): bool {
        $response = $this->client->request(HttpMethod::POST, "/servers/{$serverId}/interfaces/{$interface}/ips", [], $newServerIp);

        return $response->isSuccess;
    }

    /**
     * Delete server network interface secondary IP
     *
     * Deletes a secondary IP address from the server's network interface.
     * Fails if the IP address is the primary address of the server.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/deleteServerNetworkInterfaceIp
     * DELETE /servers/{server_id}/interfaces/{interface}/ips/{ip}
     *
     * @param string $serverId The UUID of the server
     * @param string $interface The name of the network interface
     * @param string $ip The IP address in quad dot notation
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteServerNetworkInterfaceIp(?string $serverId, ?string $interface, ?string $ip): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/servers/{$serverId}/interfaces/{$interface}/ips/{$ip}");

        return $response->isSuccess;
    }

    /**
     * Get php-fpm config for all the websites on a server
     *
     * Returns a list of php-fpm settings for each website on the server.
     * Settings are queried from the running PHP instance for each website.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerFpmSettings
     * GET /servers/{server_id}/php/fpm
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsitePhpSettings[]
     */
    public function getServerFpmSettings(?string $serverId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/php/fpm");

        return array_map(static fn (array $item): WebsitePhpSettings => WebsitePhpSettings::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Get php-fpm config for the specified website
     *
     * Returns a list of php-fpm settings for specified website on the server.
     * Settings are queried from the running PHP instance for each website.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getWebsiteFpmSettings
     * GET /servers/{server_id}/php/fpm/{website_id}
     *
     * @param string $serverId The UUID of the server
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return PhpIni|null
     */
    public function getWebsiteFpmSettings(?string $serverId, ?string $websiteId): ?PhpIni
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/php/fpm/{$websiteId}");

        return $response->decoded !== null ? PhpIni::fromArray($response->decoded) : null;
    }

    /**
     * Get server roles info
     *
     * Returns all configured roles of the given server.
     * This includes generic information about the role as well as each service in the role.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerRoles
     * GET /servers/{server_id}/roles
     *
     * @param string $serverId The UUID of the server
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return RolesInfo|null
     */
    public function getServerRoles(?string $serverId): ?RolesInfo
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/roles");

        return $response->decoded !== null ? RolesInfo::fromArray($response->decoded) : null;
    }

    /**
     * Get server role info
     *
     * Returns information about the given role on the server.
     * This includes generic information about the role as well as each service in the role.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerRole
     * GET /servers/{server_id}/roles/{role}
     *
     * @param string $serverId The UUID of the server
     * @param ServerRole $role The role of the server.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function getServerRole(?string $serverId, ?ServerRole $role): mixed
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/roles/{$role->value}");

        return $response->decoded;
    }

    /**
     * Install server role
     *
     * Installs a role on the server.
     * The backup role takes additional parameters, but all other roles take no parameters.
     * The block device size is optional and defaults to 100 GiB if not set.
     * In this case, the mount point has to be the absolute path where the backup volume should be mounted. If there is already a valid btrfs backup volume mounted at this path, besides installing the `bkupd` service, this is a noop. In the case of an existing mount point, it is verified that it has at least the block device size bytes available.
     * The block device is an absolute path that may or may not exist. If it exists, the block device size is used to verify if the device has at least the specified space available, if it doesn't exist, a loopback device is created with the this size.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/installServerRole
     * PUT /servers/{server_id}/roles/{role}
     *
     * @param string $serverId The UUID of the server
     * @param ServerRole $role The role of the server.
     * @param NewBackupRole $newBackupRole Information for the backup role.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function installServerRole(
        ?string $serverId,
        ?ServerRole $role,
        ?NewBackupRole $newBackupRole = null,
    ): bool {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/roles/{$role->value}", [], $newBackupRole);

        return $response->isSuccess;
    }

    /**
     * Update server role
     *
     * Updates role and role state.
     * A role, if activated on a server, may be in a state of enabled or disabled. If enabled, it means that new resources (e.g. websites for the application role) may be installed on the server, but if it's disabled, existing resources (e.g. websites) are kept but no new resources may be added.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/updateServerRole
     * PATCH /servers/{server_id}/roles/{role}
     *
     * @param string $serverId The UUID of the server
     * @param ServerRole $role The role of the server.
     * @param mixed $body Info for updating the server role.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateServerRole(?string $serverId, ?ServerRole $role, mixed $body): bool
    {
        $response = $this->client->request(HttpMethod::PATCH, "/servers/{$serverId}/roles/{$role->value}", [], $body);

        return $response->isSuccess;
    }

    /**
     * Uninstall a server role
     *
     * Uninstalls role from server, if role has no websites assigned to it.
     * If the role to be uninstalled is the control panel application role, the request returns an error, since this role may only be disabled but not uninstalled (since it is required to serve the control panel).
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/uninstallServerRole
     * DELETE /servers/{server_id}/roles/{role}
     *
     * @param string $serverId The UUID of the server
     * @param ServerRole $role The role of the server.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function uninstallServerRole(?string $serverId, ?ServerRole $role): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/servers/{$serverId}/roles/{$role->value}");

        return $response->isSuccess;
    }

    /**
     * Get status of a running httpd server.
     *
     * `httpd` exposes some server stats through https://httpd.apache.org/docs/2.4/mod/mod_status.html API. Complete response from `httpd` is returned as a string.
     *
     * @link https://apidocs.enhance.com/#/servers/getHttpdStatus
     * GET /servers/{server_id}/roles/{role}/httpd_status
     *
     * @param string $serverId The UUID of the server
     * @param ServerRole $role The role of the server.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return HttpdStatus|null
     */
    public function getHttpdStatus(?string $serverId, ?ServerRole $role): ?HttpdStatus
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/roles/{$role->value}/httpd_status");

        return $response->decoded !== null ? HttpdStatus::fromArray($response->decoded) : null;
    }

    /**
     * Get slave registration key
     *
     * Key may be used to install yet more servers in the Enhance cluster.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getRegistrationKey
     * GET /servers/registration-key
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getRegistrationKey(): ?string
    {
        $response = $this->client->request(HttpMethod::GET, '/servers/registration-key');

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Validate slave registration key
     *
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/validateRegistrationKey
     * POST /servers/registration-key/validate
     *
     * @param string|null $key The secret registration key
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ValidationResult|null
     */
    public function validateRegistrationKey(?string $key = null): ?ValidationResult
    {
        $query = [
            'key' => $key,
        ];
        $response = $this->client->request(HttpMethod::POST, '/servers/registration-key/validate', $query);

        return $response->decoded !== null ? ValidationResult::fromArray($response->decoded) : null;
    }

    /**
     * Get slave installation command
     *
     * Returns the install script that can be used to register more servers in the Enhance cluster.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getInstallCmd
     * GET /servers/install-cmd
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return InstallCmd|null
     */
    public function getInstallCmd(): ?InstallCmd
    {
        $response = $this->client->request(HttpMethod::GET, '/servers/install-cmd');

        return $response->decoded !== null ? InstallCmd::fromArray($response->decoded) : null;
    }

    /**
     * Returns all server groups
     *
     * Each group object has a list of ids of the servers that are part of this group.
     * Note that pagination may not be applied so this endpoint always returns all server groups.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/getServerGroups
     * GET /servers/groups
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ServerGroups|null
     */
    public function getServerGroups(): ?ServerGroups
    {
        $response = $this->client->request(HttpMethod::GET, '/servers/groups');

        return $response->decoded !== null ? ServerGroups::fromArray($response->decoded) : null;
    }

    /**
     * Creates a new server group
     *
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/createServerGroup
     * POST /servers/groups
     *
     * @param NewServerGroup $newServerGroup The name of the new server group.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createServerGroup(NewServerGroup $newServerGroup): ?NewResourceUuid
    {
        $response = $this->client->request(HttpMethod::POST, '/servers/groups', [], $newServerGroup);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Updates an existing server group's name
     *
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/updateServerGroup
     * PUT /servers/groups/{group_id}
     *
     * @param string $groupId The id of the server group.
     * @param ServerGroupUpdate $serverGroupUpdate Server group info.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateServerGroup(?string $groupId, ServerGroupUpdate $serverGroupUpdate): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/servers/groups/{$groupId}", [], $serverGroupUpdate);

        return $response->isSuccess;
    }

    /**
     * Deletes an existing server group
     *
     * Does not delete servers in the group, but instead simply unlinks those servers from this group. These servers, if any, will end up not being in any group after this call succeeds.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/servers/deleteServerGroup
     * DELETE /servers/groups/{group_id}
     *
     * @param string $groupId The id of the server group.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteServerGroup(?string $groupId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/servers/groups/{$groupId}");

        return $response->isSuccess;
    }

    /**
     * Returns a map of upgradable packages.
     *
     * Map of upgradable system packages is returned along with latest Version if the package update is available.
     *
     * @link https://apidocs.enhance.com/#/servers/getSystemPackageUpdateInfo
     * GET /servers/{server_id}/packages/update
     *
     * @param string $serverId The UUID of the server
     * @param SystemPackageName|null $systemPackageName
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return UpgradableSystemPackage|null
     */
    public function getSystemPackageUpdateInfo(
        ?string $serverId,
        ?SystemPackageName $systemPackageName = null,
    ): ?UpgradableSystemPackage {
        $query = [
            'systemPackageName' => $systemPackageName,
        ];
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/packages/update", $query);

        return $response->decoded !== null ? UpgradableSystemPackage::fromArray($response->decoded) : null;
    }

    /**
     * Updates a system package to its latest version.
     *
     * Can only update installed package to its latest version.
     *
     * @link https://apidocs.enhance.com/#/servers/updateSystemPackage
     * PUT /servers/{server_id}/packages/update
     *
     * @param string $serverId The UUID of the server
     * @param SystemPackage $systemPackage Package to be updated.
     * @param SystemPackageName|null $systemPackageName
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateSystemPackage(
        ?string $serverId,
        SystemPackage $systemPackage,
        ?SystemPackageName $systemPackageName = null,
    ): bool {
        $query = [
            'systemPackageName' => $systemPackageName,
        ];
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/packages/update", $query, $systemPackage);

        return $response->isSuccess;
    }

    /**
     * Get the value for a particular setting
     *
     * Returns the value for a particular setting as a JSON object
     *
     * @link https://apidocs.enhance.com/#/servers/getServiceSetting
     * GET /servers/{server_id}/settings/{setting_kind}
     *
     * @param string $serverId The UUID of the server
     * @param SettingKind $settingKind The type of setting being applied
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function getServiceSetting(?string $serverId, ?SettingKind $settingKind): mixed
    {
        $response = $this->client->request(HttpMethod::GET, "/servers/{$serverId}/settings/{$settingKind->value}");

        return $response->decoded;
    }

    /**
     * Set a single service setting
     *
     * Set or replace a single service level override setting
     *
     * @link https://apidocs.enhance.com/#/servers/setServiceSetting
     * PUT /servers/{server_id}/settings/{setting_kind}/{setting_key}
     *
     * @param string $serverId The UUID of the server
     * @param SettingKind $settingKind The type of setting being applied
     * @param string $settingKey A key for updating an existing setting, some known values are - hard_delete_after_secs - letsencrypt_enabled - org_websites_same_server - screenshot_driver_pool_size - screenshot_interval - sged_smtp - smtp_smart_host - website_backup - default_dns_ttl
     * @param mixed $body
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Outcome|null
     */
    public function setServiceSetting(
        ?string $serverId,
        ?SettingKind $settingKind,
        ?string $settingKey,
        mixed $body,
    ): ?Outcome {
        $response = $this->client->request(HttpMethod::PUT, "/servers/{$serverId}/settings/{$settingKind->value}/{$settingKey}", [], $body);

        return \is_string($response->decoded) || \is_int($response->decoded) ? Outcome::tryFrom($response->decoded) : null;
    }

    /**
     * Delete a single override setting
     *
     * Delete a single service setting value
     *
     * @link https://apidocs.enhance.com/#/servers/deleteServiceSetting
     * DELETE /servers/{server_id}/settings/{setting_kind}/{setting_key}
     *
     * @param string $serverId The UUID of the server
     * @param SettingKind $settingKind The type of setting being applied
     * @param string $settingKey A key for updating an existing setting, some known values are - hard_delete_after_secs - letsencrypt_enabled - org_websites_same_server - screenshot_driver_pool_size - screenshot_interval - sged_smtp - smtp_smart_host - website_backup - default_dns_ttl
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Outcome|null
     */
    public function deleteServiceSetting(?string $serverId, ?SettingKind $settingKind, ?string $settingKey): ?Outcome
    {
        $response = $this->client->request(HttpMethod::DELETE, "/servers/{$serverId}/settings/{$settingKind->value}/{$settingKey}");

        return \is_string($response->decoded) || \is_int($response->decoded) ? Outcome::tryFrom($response->decoded) : null;
    }
}
