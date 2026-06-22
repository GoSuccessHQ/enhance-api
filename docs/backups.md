# BackupsResource

Accessed via `$enhance->backups`.

| Method | Route |
| ------ | ----- |
| [`backupWebsite`](#backupwebsite) | `POST /orgs/{org_id}/websites/{website_id}/backups` |
| [`deleteAllWebsiteBackups`](#deleteallwebsitebackups) | `DELETE /backups/{server_id}/{website_id}` |
| [`deleteWebsiteBackup`](#deletewebsitebackup) | `DELETE /orgs/{org_id}/websites/{website_id}/backups/{backup_id}` |
| [`downloadWebsiteBackup`](#downloadwebsitebackup) | `GET /websites/{website_id}/backup/download` |
| [`getWebsiteBackup`](#getwebsitebackup) | `GET /orgs/{org_id}/websites/{website_id}/backups/{backup_id}` |
| [`getWebsiteBackupDirectoryTree`](#getwebsitebackupdirectorytree) | `GET /orgs/{org_id}/websites/{website_id}/backups/{backup_id}/directory_tree` |
| [`getWebsiteBackups`](#getwebsitebackups) | `GET /orgs/{org_id}/websites/{website_id}/backups` |
| [`getWebsiteRestoreLog`](#getwebsiterestorelog) | `GET /backups/{website_id}/restore/log` |
| [`getWebsiteRestoreStatus`](#getwebsiterestorestatus) | `GET /orgs/{org_id}/websites/{website_id}/backups/{backup_id}/restore_status` |
| [`listGlobalBackups`](#listglobalbackups) | `GET /backups` |
| [`restoreHardDeletedBackup`](#restoreharddeletedbackup) | `PUT /backups/{server_id}/{website_id}` |
| [`restoreWebsite`](#restorewebsite) | `PUT /orgs/{org_id}/websites/{website_id}/backups/{backup_id}` |

## backupWebsite

Create a website backup

`POST /orgs/{org_id}/websites/{website_id}/backups`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$backupOptions` | `?BackupOptions` | no |
| `$includeEmails` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->backups->backupWebsite('website-id');
```

## deleteAllWebsiteBackups

Delete all backups for a website

`DELETE /backups/{server_id}/{website_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->backups->deleteAllWebsiteBackups('server-id', 'website-id');
```

## deleteWebsiteBackup

Delete a backup

`DELETE /orgs/{org_id}/websites/{website_id}/backups/{backup_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$backupId` | `int` | yes |
| `$storageKind` | `?BackupStorageKind` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->backups->deleteWebsiteBackup('website-id', 123);
```

## downloadWebsiteBackup

Download website backup

`GET /websites/{website_id}/backup/download`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$backupDownloadKind` | `?BackupDownloadKind` | no |

```php
$result = $enhance->backups->downloadWebsiteBackup('website-id');
```

## getWebsiteBackup

Get detailed metadata of the website backup

`GET /orgs/{org_id}/websites/{website_id}/backups/{backup_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$backupId` | `int` | yes |
| `$storageKind` | `?BackupStorageKind` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->backups->getWebsiteBackup('website-id', 123);
```

## getWebsiteBackupDirectoryTree

Get the directory tree for the home dir

`GET /orgs/{org_id}/websites/{website_id}/backups/{backup_id}/directory_tree`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$backupId` | `int` | yes |
| `$offset` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->backups->getWebsiteBackupDirectoryTree('website-id', 123);
```

## getWebsiteBackups

Get all website backups metadata

`GET /orgs/{org_id}/websites/{website_id}/backups`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->backups->getWebsiteBackups('website-id');
```

## getWebsiteRestoreLog

Get the log for an ongoing restore, will return 404 if the restore is already complete

`GET /backups/{website_id}/restore/log`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->backups->getWebsiteRestoreLog('website-id');
```

## getWebsiteRestoreStatus

Get the last detailed metadata of the restored website backup.

`GET /orgs/{org_id}/websites/{website_id}/backups/{backup_id}/restore_status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$backupId` | `int` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->backups->getWebsiteRestoreStatus('website-id', 123);
```

## listGlobalBackups

List global website backups across all backup servers, by backup server ID

`GET /backups`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$showExisting` | `?bool` | no |

```php
$result = $enhance->backups->listGlobalBackups();
```

## restoreHardDeletedBackup

Restore a backup of a hard deleted website

`PUT /backups/{server_id}/{website_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->backups->restoreHardDeletedBackup('server-id', 'website-id');
```

## restoreWebsite

Restore website from a backup

`PUT /orgs/{org_id}/websites/{website_id}/backups/{backup_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$backupId` | `int` | yes |
| `$backupRestoreOptions` | `?BackupRestoreOptions` | no |
| `$storageKind` | `?BackupStorageKind` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->backups->restoreWebsite('website-id', 123);
```

