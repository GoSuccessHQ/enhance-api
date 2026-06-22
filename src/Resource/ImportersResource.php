<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\ImporterAnalyzedData;
use GoSuccess\Enhance\DTO\ImporterMigrationReqBody;
use GoSuccess\Enhance\DTO\ImportMigrationEntry;
use GoSuccess\Enhance\DTO\ImportMigrationFullListing;
use GoSuccess\Enhance\DTO\ImportMigrationLogEntry;
use GoSuccess\Enhance\DTO\ImportServerDomainsFullListing;
use GoSuccess\Enhance\DTO\ImportServerDomainsListing;
use GoSuccess\Enhance\DTO\ImportServerSettings;
use GoSuccess\Enhance\DTO\ImportServerSettingsFullListing;
use GoSuccess\Enhance\DTO\NewImportServerSettings;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\ResourceCheckError;
use GoSuccess\Enhance\DTO\TransferPleskDomainReqBody;
use GoSuccess\Enhance\DTO\TransferUserAccountReqBody;
use GoSuccess\Enhance\DTO\UpdateImportServerSettings;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "importers" section of the Enhance API.
 */
final class ImportersResource extends AbstractResource
{
    /**
     * List all server import settings
     *
     * @link https://apidocs.enhance.com/#/importers/listImportServerSettings
     * GET /orgs/{org_id}/import/server/settings
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ImportServerSettingsFullListing|null
     */
    public function listImportServerSettings(?string $orgId = null): ?ImportServerSettingsFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/import/server/settings");

        return $response->decoded !== null ? ImportServerSettingsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create settings for the server import
     *
     * Create settings for the server import.
     *
     * @link https://apidocs.enhance.com/#/importers/createImportServerSettings
     * POST /orgs/{org_id}/import/server/settings
     *
     * @param NewImportServerSettings $newImportServerSettings
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createImportServerSettings(
        NewImportServerSettings $newImportServerSettings,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/import/server/settings", [], $newImportServerSettings);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Pull domains form the remote server.
     *
     * Pull domains form the remote server, and cache them.
     * To get cached domains, use getImportServerDomainsCached.
     *
     * @link https://apidocs.enhance.com/#/importers/getImportServerPullDomains
     * GET /orgs/{org_id}/import/server/{server_id}/pull-domains
     *
     * @param string $serverId The UUID of the server
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ImportServerDomainsFullListing|null
     */
    public function getImportServerPullDomains(
        ?string $serverId,
        ?string $orgId = null,
    ): ?ImportServerDomainsFullListing {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/import/server/{$serverId}/pull-domains");

        return $response->decoded !== null ? ImportServerDomainsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Returns cached domains
     *
     * Returns cached domains.
     *
     * @link https://apidocs.enhance.com/#/importers/getImportServerDomainsCached
     * GET /orgs/{org_id}/import/server/{server_id}/cached-domains
     *
     * @param string $serverId The UUID of the server
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $searchDomain Look for a specific domain in the result set.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ImportServerDomainsListing|null
     */
    public function getImportServerDomainsCached(
        ?string $serverId,
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortOrder = null,
        ?string $searchDomain = null,
        ?string $sortBy = null,
        ?string $orgId = null,
    ): ?ImportServerDomainsListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortOrder' => $sortOrder,
            'searchDomain' => $searchDomain,
            'sortBy' => $sortBy,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/import/server/{$serverId}/cached-domains", $query);

        return $response->decoded !== null ? ImportServerDomainsListing::fromArray($response->decoded) : null;
    }

    /**
     * Transfer user account from remote cPanel server
     *
     * Transfer user account from remote Plesk server to Enhance server.
     * It's an async endpoint. To get transfer result, you have to call getImportMigration.
     *
     * @link https://apidocs.enhance.com/#/importers/transferPleskDomain
     * POST /orgs/{org_id}/import/plesk-server/{server_id}/domain
     *
     * @param string $serverId The UUID of the server
     * @param TransferPleskDomainReqBody $transferPleskDomainReqBody
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function transferPleskDomain(
        ?string $serverId,
        ?TransferPleskDomainReqBody $transferPleskDomainReqBody = null,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/import/plesk-server/{$serverId}/domain", [], $transferPleskDomainReqBody);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Transfer user account from remote cPanel server
     *
     * Transfer user account from remote cPanel server to Enhance server.
     * It's an async endpoint. To get transfer result, you have to call getImportMigration.
     *
     * @link https://apidocs.enhance.com/#/importers/transferCPanelUserAccount
     * POST /orgs/{org_id}/import/server/{server_id}/account/{user_id}
     *
     * @param string $serverId The UUID of the server
     * @param string $userId The ID of the remote cPanel user
     * @param TransferUserAccountReqBody $transferUserAccountReqBody
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function transferCPanelUserAccount(
        ?string $serverId,
        ?string $userId,
        ?TransferUserAccountReqBody $transferUserAccountReqBody = null,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/import/server/{$serverId}/account/{$userId}", [], $transferUserAccountReqBody);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Get settings for the server import
     *
     * Get settings for the server import.
     * Note: returned data does not contain ssh private key or any passwords/tokens.
     *
     * @link https://apidocs.enhance.com/#/importers/getImportServerSettings
     * GET /orgs/{org_id}/import/server/{server_id}/settings
     *
     * @param string $serverId The UUID of the server
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ImportServerSettings|null
     */
    public function getImportServerSettings(?string $serverId, ?string $orgId = null): ?ImportServerSettings
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/import/server/{$serverId}/settings");

        return $response->decoded !== null ? ImportServerSettings::fromArray($response->decoded) : null;
    }

    /**
     * Update settings for the server import
     *
     * Update settings for the server import.
     *
     * @link https://apidocs.enhance.com/#/importers/updateImportServerSettings
     * PATCH /orgs/{org_id}/import/server/{server_id}/settings
     *
     * @param string $serverId The UUID of the server
     * @param UpdateImportServerSettings $updateImportServerSettings
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateImportServerSettings(
        ?string $serverId,
        UpdateImportServerSettings $updateImportServerSettings,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/import/server/{$serverId}/settings", [], $updateImportServerSettings);

        return $response->isSuccess;
    }

    /**
     * Delete settings for the server import
     *
     * Delete settings for the server import.
     *
     * @link https://apidocs.enhance.com/#/importers/deleteImportServerSettings
     * DELETE /orgs/{org_id}/import/server/{server_id}/settings
     *
     * @param string $serverId The UUID of the server
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteImportServerSettings(?string $serverId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/import/server/{$serverId}/settings");

        return $response->isSuccess;
    }

    /**
     * Get the log for an import migration
     *
     * Fetches the import migration log for a single import migration.
     *
     * @link https://apidocs.enhance.com/#/importers/getImportMigrationLog
     * GET /v2/orgs/{org_id}/import/{import_migration_id}/log
     *
     * @param string $importMigrationId The ID of the import migration being acted upon.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ImportMigrationLogEntry[]
     */
    public function getImportMigrationLog(?string $importMigrationId, ?string $orgId = null): array
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/v2/orgs/{$orgId}/import/{$importMigrationId}/log");

        return array_map(static fn (array $item): ImportMigrationLogEntry => ImportMigrationLogEntry::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Fetches single migration details
     *
     * @link https://apidocs.enhance.com/#/importers/getImportMigration
     * GET /v2/orgs/{org_id}/import/{import_migration_id}
     *
     * @param string $importMigrationId The ID of the import migration being acted upon.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ImportMigrationEntry|null
     */
    public function getImportMigration(?string $importMigrationId, ?string $orgId = null): ?ImportMigrationEntry
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/v2/orgs/{$orgId}/import/{$importMigrationId}");

        return $response->decoded !== null ? ImportMigrationEntry::fromArray($response->decoded) : null;
    }

    /**
     * Create a new import migration.
     *
     * Create a new import migration for a given import type.
     *
     * @link https://apidocs.enhance.com/#/importers/createImportMigration
     * POST /v2/orgs/{org_id}/import/{import_migration_id}
     *
     * @param string $importMigrationId The ID of the import migration being acted upon.
     * @param ImporterMigrationReqBody $importerMigrationReqBody
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createImportMigration(
        ?string $importMigrationId,
        ?ImporterMigrationReqBody $importerMigrationReqBody = null,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/v2/orgs/{$orgId}/import/{$importMigrationId}", [], $importerMigrationReqBody);

        return $response->isSuccess;
    }

    /**
     * Delete single migration
     *
     * Delete a single migration with the uploaded file.
     *
     * @link https://apidocs.enhance.com/#/importers/deleteImportMigration
     * DELETE /v2/orgs/{org_id}/import/{import_migration_id}
     *
     * @param string $importMigrationId The ID of the import migration being acted upon.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteImportMigration(?string $importMigrationId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/v2/orgs/{$orgId}/import/{$importMigrationId}");

        return $response->isSuccess;
    }

    /**
     * Check if all resources from the imported migration could be created.
     *
     * Check if all resources from the imported migration could be created.
     *
     * If all resources could be created, 200 is returned with an empty `ResourceCheckError`.
     * However, if any error occurs, 200 is returned with a non-empty `ResourceCheckError`.
     *
     * In case of import failure, you can rerun importing by setting forceQueue to true.
     * Before doing so, it's required to remove any already imported resources. Otherwise,
     * the import will fail.
     *
     * @link https://apidocs.enhance.com/#/importers/checkImportMigrationResources
     * POST /v2/orgs/{org_id}/import/{import_migration_id}/resource
     *
     * @param string $importMigrationId The ID of the import migration being acted upon.
     * @param ImporterMigrationReqBody $importerMigrationReqBody
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ResourceCheckError|null
     */
    public function checkImportMigrationResources(
        ?string $importMigrationId,
        ?ImporterMigrationReqBody $importerMigrationReqBody = null,
        ?string $orgId = null,
    ): ?ResourceCheckError {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/v2/orgs/{$orgId}/import/{$importMigrationId}/resource", [], $importerMigrationReqBody);

        return $response->decoded !== null ? ResourceCheckError::fromArray($response->decoded) : null;
    }

    /**
     * Get import migration information
     *
     * Get analyzed informations about import.
     *
     * Information contains details about domains, ftp users, databases,
     * crontabs and mailboxes.
     *
     * @link https://apidocs.enhance.com/#/importers/getImportMigrationData
     * GET /v2/orgs/{org_id}/import/{import_migration_id}/analyze
     *
     * @param string $importMigrationId The ID of the import migration being acted upon.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ImporterAnalyzedData|null
     */
    public function getImportMigrationData(?string $importMigrationId, ?string $orgId = null): ?ImporterAnalyzedData
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/v2/orgs/{$orgId}/import/{$importMigrationId}/analyze");

        return $response->decoded !== null ? ImporterAnalyzedData::fromArray($response->decoded) : null;
    }

    /**
     * Analyze imported migration
     *
     * Analyze import and store results into database.
     *
     * Note: the endpoint returns immediately, and you have to poll status
     * via `getImportMigration` endpoint. If you want to see detailed error,
     * please call `getImportMigrationLog`.
     *
     * @link https://apidocs.enhance.com/#/importers/analyzeImportMigration
     * POST /v2/orgs/{org_id}/import/{import_migration_id}/analyze
     *
     * @param string $importMigrationId The ID of the import migration being acted upon.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function analyzeImportMigration(?string $importMigrationId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/v2/orgs/{$orgId}/import/{$importMigrationId}/analyze");

        return $response->isSuccess;
    }

    /**
     * Upload file for analyzing and processing.
     *
     * Uploads an import file. File must be in `tar.gz` format, and only cPanel
     * and Plesk uploads are allowed.
     *
     * The max allowed size is 100 GB.
     *
     * @link https://apidocs.enhance.com/#/importers/uploadImportMigration
     * POST /v2/orgs/{org_id}/import/upload/{import_migration_kind}
     *
     * @param string $importMigrationKind The type of migration file being uploaded.
     * @param array<string, mixed> $formData Multipart form fields.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function uploadImportMigration(
        ?string $importMigrationKind,
        ?array $formData = null,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/v2/orgs/{$orgId}/import/upload/{$importMigrationKind}", [], $formData, 'multipart/form-data');

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * List all import migrations
     *
     * @link https://apidocs.enhance.com/#/importers/getImportMigrations
     * GET /v2/orgs/{org_id}/import
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ImportMigrationFullListing|null
     */
    public function getImportMigrations(?string $orgId = null): ?ImportMigrationFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/v2/orgs/{$orgId}/import");

        return $response->decoded !== null ? ImportMigrationFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Scan for manually uploaded cPanel backups.
     *
     * Will scan /var/local/enhance/orchd/importer for files matching
     * cpmove*.tar.gz or backup*.tar.gz and will add them to the importer
     * database for analysis.  An array of migration IDs will be returned.
     * Master organisation only.
     *
     * @link https://apidocs.enhance.com/#/importers/scanImportMigrations
     * GET /v2/import/scan
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function scanImportMigrations(): array
    {
        $response = $this->client->request(HttpMethod::GET, '/v2/import/scan');

        return (array)($response->decoded ?? []);
    }
}
