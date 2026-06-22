# PostgresqlResource

Accessed via `$enhance->postgresql`.

| Method | Route |
| ------ | ----- |
| [`createWebsitePostgresqlDb`](#createwebsitepostgresqldb) | `POST /orgs/{org_id}/websites/{website_id}/postgresql-dbs` |
| [`createWebsitePostgresqlUser`](#createwebsitepostgresqluser) | `POST /orgs/{org_id}/websites/{website_id}/postgresql-users` |
| [`deleteWebsitePostgresqlDb`](#deletewebsitepostgresqldb) | `DELETE /orgs/{org_id}/websites/{website_id}/postgresql-dbs/{db_name}` |
| [`deleteWebsitePostgresqlUser`](#deletewebsitepostgresqluser) | `DELETE /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}` |
| [`getWebsitePostgresqlDbs`](#getwebsitepostgresqldbs) | `GET /orgs/{org_id}/websites/{website_id}/postgresql-dbs` |
| [`getWebsitePostgresqlUsers`](#getwebsitepostgresqlusers) | `GET /orgs/{org_id}/websites/{website_id}/postgresql-users` |
| [`grantPostgresqlUserDbPrivileges`](#grantpostgresqluserdbprivileges) | `POST /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}/privileges` |
| [`revokePostgresqlUserDbPrivileges`](#revokepostgresqluserdbprivileges) | `DELETE /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}/privileges/{db_name}` |
| [`updateWebsitePostgresqlUser`](#updatewebsitepostgresqluser) | `PATCH /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}` |

## createWebsitePostgresqlDb

Create a PostgreSQL database for website

`POST /orgs/{org_id}/websites/{website_id}/postgresql-dbs`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newMySQLDB` | `NewMySQLDB` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewMySQLDB;

$newMySQLDB = new NewMySQLDB();
$newMySQLDB->name = 'example';

$result = $enhance->postgresql->createWebsitePostgresqlDb('website-id', $newMySQLDB);
```

## createWebsitePostgresqlUser

Create website PostgreSQL database user

`POST /orgs/{org_id}/websites/{website_id}/postgresql-users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newPostgresqlUser` | `NewPostgresqlUser` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewPostgresqlUser;

$newPostgresqlUser = new NewPostgresqlUser();
$newPostgresqlUser->username = 'example';
$newPostgresqlUser->password = 's3cret';

$result = $enhance->postgresql->createWebsitePostgresqlUser('website-id', $newPostgresqlUser);
```

## deleteWebsitePostgresqlDb

Delete website PostgreSQL database

`DELETE /orgs/{org_id}/websites/{website_id}/postgresql-dbs/{db_name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$dbName` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->postgresql->deleteWebsitePostgresqlDb('website-id', 'example');
```

## deleteWebsitePostgresqlUser

Delete website PostgreSQL database user

`DELETE /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->postgresql->deleteWebsitePostgresqlUser('website-id', 'example');
```

## getWebsitePostgresqlDbs

Get website PostgreSQL databases

`GET /orgs/{org_id}/websites/{website_id}/postgresql-dbs`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->postgresql->getWebsitePostgresqlDbs('website-id');
```

## getWebsitePostgresqlUsers

Get website PostgreSQL database users

`GET /orgs/{org_id}/websites/{website_id}/postgresql-users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->postgresql->getWebsitePostgresqlUsers('website-id');
```

## grantPostgresqlUserDbPrivileges

Grant privileges on a specific database

`POST /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}/privileges`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$value` | `?string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->postgresql->grantPostgresqlUserDbPrivileges('website-id', 'example', 'example');
```

## revokePostgresqlUserDbPrivileges

Remove privileges on this database

`DELETE /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}/privileges/{db_name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$dbName` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->postgresql->revokePostgresqlUserDbPrivileges('website-id', 'example', 'example');
```

## updateWebsitePostgresqlUser

Update website PostgreSQL database user

`PATCH /orgs/{org_id}/websites/{website_id}/postgresql-users/{username}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$postgresqlUserUpdate` | `PostgresqlUserUpdate` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\PostgresqlUserUpdate;

$postgresqlUserUpdate = new PostgresqlUserUpdate();
$postgresqlUserUpdate->password = 's3cret';

$result = $enhance->postgresql->updateWebsitePostgresqlUser('website-id', 'example', $postgresqlUserUpdate);
```

