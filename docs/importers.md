# ImportersResource

Accessed via `$enhance->importers`.

| Method | Route |
| ------ | ----- |
| [`analyzeImportMigration`](#analyzeimportmigration) | `POST /v2/orgs/{org_id}/import/{import_migration_id}/analyze` |
| [`checkImportMigrationResources`](#checkimportmigrationresources) | `POST /v2/orgs/{org_id}/import/{import_migration_id}/resource` |
| [`createImportMigration`](#createimportmigration) | `POST /v2/orgs/{org_id}/import/{import_migration_id}` |
| [`createImportServerSettings`](#createimportserversettings) | `POST /orgs/{org_id}/import/server/settings` |
| [`deleteImportMigration`](#deleteimportmigration) | `DELETE /v2/orgs/{org_id}/import/{import_migration_id}` |
| [`deleteImportServerSettings`](#deleteimportserversettings) | `DELETE /orgs/{org_id}/import/server/{server_id}/settings` |
| [`getImportMigration`](#getimportmigration) | `GET /v2/orgs/{org_id}/import/{import_migration_id}` |
| [`getImportMigrationData`](#getimportmigrationdata) | `GET /v2/orgs/{org_id}/import/{import_migration_id}/analyze` |
| [`getImportMigrationLog`](#getimportmigrationlog) | `GET /v2/orgs/{org_id}/import/{import_migration_id}/log` |
| [`getImportMigrations`](#getimportmigrations) | `GET /v2/orgs/{org_id}/import` |
| [`getImportServerDomainsCached`](#getimportserverdomainscached) | `GET /orgs/{org_id}/import/server/{server_id}/cached-domains` |
| [`getImportServerPullDomains`](#getimportserverpulldomains) | `GET /orgs/{org_id}/import/server/{server_id}/pull-domains` |
| [`getImportServerSettings`](#getimportserversettings) | `GET /orgs/{org_id}/import/server/{server_id}/settings` |
| [`listImportServerSettings`](#listimportserversettings) | `GET /orgs/{org_id}/import/server/settings` |
| [`scanImportMigrations`](#scanimportmigrations) | `GET /v2/import/scan` |
| [`transferCPanelUserAccount`](#transfercpaneluseraccount) | `POST /orgs/{org_id}/import/server/{server_id}/account/{user_id}` |
| [`transferPleskDomain`](#transferpleskdomain) | `POST /orgs/{org_id}/import/plesk-server/{server_id}/domain` |
| [`updateImportServerSettings`](#updateimportserversettings) | `PATCH /orgs/{org_id}/import/server/{server_id}/settings` |
| [`uploadImportMigration`](#uploadimportmigration) | `POST /v2/orgs/{org_id}/import/upload/{import_migration_kind}` |

## analyzeImportMigration

Analyze imported migration

`POST /v2/orgs/{org_id}/import/{import_migration_id}/analyze`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$importMigrationId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->analyzeImportMigration('importMigration-id');
```

## checkImportMigrationResources

Check if all resources from the imported migration could be created.

`POST /v2/orgs/{org_id}/import/{import_migration_id}/resource`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$importMigrationId` | `string` | yes |
| `$importerMigrationReqBody` | `?ImporterMigrationReqBody` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->checkImportMigrationResources('importMigration-id');
```

## createImportMigration

Create a new import migration.

`POST /v2/orgs/{org_id}/import/{import_migration_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$importMigrationId` | `string` | yes |
| `$importerMigrationReqBody` | `?ImporterMigrationReqBody` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->createImportMigration('importMigration-id');
```

## createImportServerSettings

Create settings for the server import

`POST /orgs/{org_id}/import/server/settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newImportServerSettings` | `NewImportServerSettings` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewImportServerSettings;

$newImportServerSettings = new NewImportServerSettings();
$newImportServerSettings->sshPrivateKey = 'example';
$newImportServerSettings->sshPublicKey = 'example';
$newImportServerSettings->allowPartialSync = true;
// ... set further properties as needed

$result = $enhance->importers->createImportServerSettings($newImportServerSettings);
```

## deleteImportMigration

Delete single migration

`DELETE /v2/orgs/{org_id}/import/{import_migration_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$importMigrationId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->deleteImportMigration('importMigration-id');
```

## deleteImportServerSettings

Delete settings for the server import

`DELETE /orgs/{org_id}/import/server/{server_id}/settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->deleteImportServerSettings('server-id');
```

## getImportMigration

Fetches single migration details

`GET /v2/orgs/{org_id}/import/{import_migration_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$importMigrationId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->getImportMigration('importMigration-id');
```

## getImportMigrationData

Get import migration information

`GET /v2/orgs/{org_id}/import/{import_migration_id}/analyze`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$importMigrationId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->getImportMigrationData('importMigration-id');
```

## getImportMigrationLog

Get the log for an import migration

`GET /v2/orgs/{org_id}/import/{import_migration_id}/log`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$importMigrationId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->getImportMigrationLog('importMigration-id');
```

## getImportMigrations

List all import migrations

`GET /v2/orgs/{org_id}/import`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->getImportMigrations();
```

## getImportServerDomainsCached

Returns cached domains

`GET /orgs/{org_id}/import/server/{server_id}/cached-domains`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortOrder` | `?string` | no |
| `$searchDomain` | `?string` | no |
| `$sortBy` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->getImportServerDomainsCached('server-id');
```

## getImportServerPullDomains

Pull domains form the remote server.

`GET /orgs/{org_id}/import/server/{server_id}/pull-domains`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->getImportServerPullDomains('server-id');
```

## getImportServerSettings

Get settings for the server import

`GET /orgs/{org_id}/import/server/{server_id}/settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->getImportServerSettings('server-id');
```

## listImportServerSettings

List all server import settings

`GET /orgs/{org_id}/import/server/settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->listImportServerSettings();
```

## scanImportMigrations

Scan for manually uploaded cPanel backups.

`GET /v2/import/scan`

```php
$result = $enhance->importers->scanImportMigrations();
```

## transferCPanelUserAccount

Transfer user account from remote cPanel server

`POST /orgs/{org_id}/import/server/{server_id}/account/{user_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$userId` | `string` | yes |
| `$transferUserAccountReqBody` | `?TransferUserAccountReqBody` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->transferCPanelUserAccount('server-id', 'user-id');
```

## transferPleskDomain

Transfer user account from remote cPanel server

`POST /orgs/{org_id}/import/plesk-server/{server_id}/domain`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$transferPleskDomainReqBody` | `?TransferPleskDomainReqBody` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->transferPleskDomain('server-id');
```

## updateImportServerSettings

Update settings for the server import

`PATCH /orgs/{org_id}/import/server/{server_id}/settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$updateImportServerSettings` | `UpdateImportServerSettings` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateImportServerSettings;

$updateImportServerSettings = new UpdateImportServerSettings();
$updateImportServerSettings->hostname = 'example';
$updateImportServerSettings->friendlyName = 'example';
$updateImportServerSettings->sshUser = 'example';
// ... set further properties as needed

$result = $enhance->importers->updateImportServerSettings('server-id', $updateImportServerSettings);
```

## uploadImportMigration

Upload file for analyzing and processing.

`POST /v2/orgs/{org_id}/import/upload/{import_migration_kind}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$importMigrationKind` | `string` | yes |
| `$formData` | `?array` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->importers->uploadImportMigration('example');
```

