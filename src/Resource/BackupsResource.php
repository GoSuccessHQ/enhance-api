<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\Backup;
use GoSuccess\Enhance\DTO\BackupDetailed;
use GoSuccess\Enhance\DTO\BackupOptions;
use GoSuccess\Enhance\DTO\BackupRestoreOptions;
use GoSuccess\Enhance\DTO\BackupsFullListing;
use GoSuccess\Enhance\DTO\DirectoryTreeNode;
use GoSuccess\Enhance\DTO\RestoreDetailed;
use GoSuccess\Enhance\Enum\BackupDownloadKind;
use GoSuccess\Enhance\Enum\BackupStorageKind;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "backups" section of the Enhance API.
 */
final class BackupsResource extends AbstractResource
{
    /**
     * Get all website backups metadata
     *
     * Returns a list of all website backups.
     * This includes the backups that were not successful as well, or backups that were only partially successful (e.g. the home directory was backed up but not the databases).
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/backups/getWebsiteBackups
     * GET /orgs/{org_id}/websites/{website_id}/backups
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return BackupsFullListing|null
     */
    public function getWebsiteBackups(?string $websiteId, ?string $orgId = null): ?BackupsFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/backups");

        return $response->decoded !== null ? BackupsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create a website backup
     *
     * Creates a new full website backup.
     * This is a long running operation and the request doesn't return until all backups are finished, or an error occurs. If you want to see the backup progress, you can periodically query the backup status via `getWebsiteBackupStatus`.
     * Backups consists of several components, and a component is the smallest granularity of a backup. The components are: backing up of the website's home directory, the website's mysql databases, and the website's emails.
     * The backups may be partial, that is, some out of all backup components may succeeded, but e.g. the backup of the mysql databases may fail. In both cases, the backup snapshot is still created, and the mysql backups are marked as failed for the backup record.
     * Email backups are not done automatically, as they need not be backed up in most cases (due to the expectation that customers would want to backup and then roll back a website after filesystem or database changes, which wouldn't concern emails). Doing so redundantly is time consuming so it is skipped by default, but emails may be backed up if the `includeEmails` query parameter is set to true.
     * If the backup fails altogether, this endpoint still returns a 201 Created, but in this case only the metadata in `orchd`'s db is inserted, no actual backup snapshot is created. This is for information purposes, such a backup, perhaps needless to say, cannot be restored.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/backups/backupWebsite
     * POST /orgs/{org_id}/websites/{website_id}/backups
     *
     * @param string $websiteId The id of the website.
     * @param BackupOptions $backupOptions
     * @param bool|null $includeEmails The boolean flag used to include emails in the backup.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Backup|null
     */
    public function backupWebsite(
        ?string $websiteId,
        ?BackupOptions $backupOptions = null,
        ?bool $includeEmails = null,
        ?string $orgId = null,
    ): ?Backup {
        $orgId = $this->orgId($orgId);
        $query = [
            'includeEmails' => $includeEmails,
        ];
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/backups", $query, $backupOptions);

        return $response->decoded !== null ? Backup::fromArray($response->decoded) : null;
    }

    /**
     * Download website backup
     *
     * Streams a download of the current website and metadata to the browser.
     *
     * @link https://apidocs.enhance.com/#/backups/downloadWebsiteBackup
     * GET /websites/{website_id}/backup/download
     *
     * @param string $websiteId The id of the website.
     * @param BackupDownloadKind|null $backupDownloadKind
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string Raw response body
     */
    public function downloadWebsiteBackup(?string $websiteId, ?BackupDownloadKind $backupDownloadKind = null): string
    {
        $query = [
            'backupDownloadKind' => $backupDownloadKind,
        ];
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/backup/download", $query);

        return $response->rawBody;
    }

    /**
     * Get detailed metadata of the website backup
     *
     * Returns detailed information about the backup.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/backups/getWebsiteBackup
     * GET /orgs/{org_id}/websites/{website_id}/backups/{backup_id}
     *
     * @param string $websiteId The id of the website.
     * @param int $backupId The id of the backup.
     * @param BackupStorageKind|null $storageKind The storage kind of the requested backup.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return BackupDetailed|null
     */
    public function getWebsiteBackup(
        ?string $websiteId,
        ?int $backupId,
        ?BackupStorageKind $storageKind = null,
        ?string $orgId = null,
    ): ?BackupDetailed {
        $orgId = $this->orgId($orgId);
        $query = [
            'storageKind' => $storageKind,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/backups/{$backupId}", $query);

        return $response->decoded !== null ? BackupDetailed::fromArray($response->decoded) : null;
    }

    /**
     * Restore website from a backup
     *
     * Restores the website's home directory and MySQL databases, and optionally the website's email mailboxes if the `includeEmails` query parameter is set to true.
     * Note that if the website was deleted or any of its entities was deleted through `orchd` (via one or more of the DELETE endpoints), this endpoint does not restore those resources. It may only be used when e.g. one wants to restore the previous state of the mailbox of an existing account (but not a deleted account), or the state of an existing website's home directory.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/backups/restoreWebsite
     * PUT /orgs/{org_id}/websites/{website_id}/backups/{backup_id}
     *
     * @param string $websiteId The id of the website.
     * @param int $backupId The id of the backup.
     * @param BackupRestoreOptions $backupRestoreOptions The options used to define what will be restored from the backup snapshot.
     * @param BackupStorageKind|null $storageKind The storage kind of the requested backup.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function restoreWebsite(
        ?string $websiteId,
        ?int $backupId,
        ?BackupRestoreOptions $backupRestoreOptions = null,
        ?BackupStorageKind $storageKind = null,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $query = [
            'storageKind' => $storageKind,
        ];
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/backups/{$backupId}", $query, $backupRestoreOptions);

        return $response->isSuccess;
    }

    /**
     * Delete a backup
     *
     * Deletes a backup.
     * If the backup refers to a (partially) successful backup, both its metadata and the backup snapshot on the backup server will be removed, otherwise just the metadata is removed.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/backups/deleteWebsiteBackup
     * DELETE /orgs/{org_id}/websites/{website_id}/backups/{backup_id}
     *
     * @param string $websiteId The id of the website.
     * @param int $backupId The id of the backup.
     * @param BackupStorageKind|null $storageKind The storage kind of the requested backup.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteBackup(
        ?string $websiteId,
        ?int $backupId,
        ?BackupStorageKind $storageKind = null,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $query = [
            'storageKind' => $storageKind,
        ];
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/backups/{$backupId}", $query);

        return $response->isSuccess;
    }

    /**
     * Get the last detailed metadata of the restored website backup.
     *
     * Returns the last detailed information about the restored backup.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/backups/getWebsiteRestoreStatus
     * GET /orgs/{org_id}/websites/{website_id}/backups/{backup_id}/restore_status
     *
     * @param string $websiteId The id of the website.
     * @param int $backupId The id of the backup.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return RestoreDetailed|null
     */
    public function getWebsiteRestoreStatus(
        ?string $websiteId,
        ?int $backupId,
        ?string $orgId = null,
    ): ?RestoreDetailed {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/backups/{$backupId}/restore_status");

        return $response->decoded !== null ? RestoreDetailed::fromArray($response->decoded) : null;
    }

    /**
     * Get the directory tree for the home dir
     *
     * Will return the directory tree for the home directory of the website at the time of the snapshot.  Only works with Enhance backups, not S3.
     *
     * @link https://apidocs.enhance.com/#/backups/getWebsiteBackupDirectoryTree
     * GET /orgs/{org_id}/websites/{website_id}/backups/{backup_id}/directory_tree
     *
     * @param string $websiteId The id of the website.
     * @param int $backupId The id of the backup.
     * @param string|null $offset
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DirectoryTreeNode[]
     */
    public function getWebsiteBackupDirectoryTree(
        ?string $websiteId,
        ?int $backupId,
        ?string $offset = null,
        ?string $orgId = null,
    ): array {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/backups/{$backupId}/directory_tree", $query);

        return array_map(static fn (array $item): DirectoryTreeNode => DirectoryTreeNode::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * List global website backups across all backup servers, by backup server ID
     *
     * @link https://apidocs.enhance.com/#/backups/listGlobalBackups
     * GET /backups
     *
     * @param bool|null $showExisting Show global backups belonging to websites that already exist on the cluster
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function listGlobalBackups(?bool $showExisting = null): mixed
    {
        $query = [
            'showExisting' => $showExisting,
        ];
        $response = $this->client->request(HttpMethod::GET, '/backups', $query);

        return $response->decoded;
    }

    /**
     * Restore a backup of a hard deleted website
     *
     * @link https://apidocs.enhance.com/#/backups/restoreHardDeletedBackup
     * PUT /backups/{server_id}/{website_id}
     *
     * @param string $serverId The UUID of the server
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function restoreHardDeletedBackup(?string $serverId, ?string $websiteId): ?string
    {
        $response = $this->client->request(HttpMethod::PUT, "/backups/{$serverId}/{$websiteId}");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Delete all backups for a website
     *
     * @link https://apidocs.enhance.com/#/backups/deleteAllWebsiteBackups
     * DELETE /backups/{server_id}/{website_id}
     *
     * @param string $serverId The UUID of the server
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteAllWebsiteBackups(?string $serverId, ?string $websiteId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/backups/{$serverId}/{$websiteId}");

        return $response->isSuccess;
    }

    /**
     * Get the log for an ongoing restore, will return 404 if the restore is already complete
     *
     * @link https://apidocs.enhance.com/#/backups/getWebsiteRestoreLog
     * GET /backups/{website_id}/restore/log
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function getWebsiteRestoreLog(?string $websiteId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/backups/{$websiteId}/restore/log");

        return (array)($response->decoded ?? []);
    }
}
