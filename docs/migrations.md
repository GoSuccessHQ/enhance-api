# MigrationsResource

Accessed via `$enhance->migrations`.

| Method | Route |
| ------ | ----- |
| [`createMigration`](#createmigration) | `POST /migrations` |
| [`createMigrationSession`](#createmigrationsession) | `POST /migrations/sessions` |
| [`getMigration`](#getmigration) | `GET /migrations/{migrationId}` |
| [`getMigrationLog`](#getmigrationlog) | `GET /migrations/{migrationId}/log` |
| [`getMigrationSessions`](#getmigrationsessions) | `GET /migrations/sessions` |
| [`getMigrations`](#getmigrations) | `GET /migrations` |

## createMigration

Create website role migration

`POST /migrations`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newMigrationDetails` | `NewMigrationDetails` | yes |

```php
use GoSuccess\Enhance\DTO\NewMigrationDetails;
use GoSuccess\Enhance\Enum\ServerRole;

$newMigrationDetails = new NewMigrationDetails();
$newMigrationDetails->websiteId = 'website-id';
$newMigrationDetails->destServerId = 'destServer-id';
$newMigrationDetails->serverRole = ServerRole::Email;

$result = $enhance->migrations->createMigration($newMigrationDetails);
```

## createMigrationSession

Create bulk website role migrations

`POST /migrations/sessions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$items` | `?array` | yes |

```php
$result = $enhance->migrations->createMigrationSession([]);
```

## getMigration

Get a single migration

`GET /migrations/{migrationId}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$migrationId` | `string` | yes |

```php
$result = $enhance->migrations->getMigration('migration-id');
```

## getMigrationLog

Get the log for a migration

`GET /migrations/{migrationId}/log`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$migrationId` | `string` | yes |

```php
$result = $enhance->migrations->getMigrationLog('migration-id');
```

## getMigrationSessions

Get website role migration sessions

`GET /migrations/sessions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortOrder` | `?string` | no |
| `$sortBy` | `?string` | no |
| `$createdBy` | `?string` | no |
| `$searchDomain` | `?string` | no |

```php
$result = $enhance->migrations->getMigrationSessions();
```

## getMigrations

Get website role migrations

`GET /migrations`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortOrder` | `?string` | no |
| `$sortBy` | `?string` | no |
| `$searchDomain` | `?string` | no |
| `$migrationStatus` | `?MigrationStatus` | no |
| `$sessionId` | `?string` | no |

```php
$result = $enhance->migrations->getMigrations();
```

