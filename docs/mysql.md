# MysqlResource

Accessed via `$enhance->mysql`.

| Method | Route |
| ------ | ----- |
| [`createWebsiteMySQLDB`](#createwebsitemysqldb) | `POST /orgs/{org_id}/websites/{website_id}/mysql-dbs` |
| [`createWebsiteMySQLUser`](#createwebsitemysqluser) | `POST /orgs/{org_id}/websites/{website_id}/mysql-users` |
| [`createWebsiteMySQLUserAccessHosts`](#createwebsitemysqluseraccesshosts) | `POST /orgs/{org_id}/websites/{website_id}/mysql-users/{username}/access-hosts` |
| [`deleteWebsiteMySQLDB`](#deletewebsitemysqldb) | `DELETE /orgs/{org_id}/websites/{website_id}/mysql-dbs/{db_name}` |
| [`deleteWebsiteMySQLUser`](#deletewebsitemysqluser) | `DELETE /orgs/{org_id}/websites/{website_id}/mysql-users/{username}` |
| [`deleteWebsiteMySQLUserAccessHosts`](#deletewebsitemysqluseraccesshosts) | `DELETE /orgs/{org_id}/websites/{website_id}/mysql-users/{username}/access-hosts` |
| [`downloadSql`](#downloadsql) | `GET /orgs/{org_id}/websites/{website_id}/mysql-dbs/{db_name}/sql` |
| [`getPhpMyAdminSSOUrl`](#getphpmyadminssourl) | `GET /orgs/{org_id}/websites/{website_id}/mysql-dbs/{db_name}/sso` |
| [`getPhpMyAdminWebsiteSSOUrl`](#getphpmyadminwebsitessourl) | `GET /orgs/{org_id}/websites/{website_id}/phpmyadmin` |
| [`getWebsiteMySQLDBs`](#getwebsitemysqldbs) | `GET /orgs/{org_id}/websites/{website_id}/mysql-dbs` |
| [`getWebsiteMySQLUsers`](#getwebsitemysqlusers) | `GET /orgs/{org_id}/websites/{website_id}/mysql-users` |
| [`setWebsiteMySQLUserPrivileges`](#setwebsitemysqluserprivileges) | `PUT /orgs/{org_id}/websites/{website_id}/mysql-users/{username}/privileges` |
| [`updateWebsiteMySQLUser`](#updatewebsitemysqluser) | `PUT /orgs/{org_id}/websites/{website_id}/mysql-users/{username}` |
| [`uploadSql`](#uploadsql) | `POST /v2/websites/{websiteId}/mysql/{db_id}/sql` |

## createWebsiteMySQLDB

Create a MySQL database for website

`POST /orgs/{org_id}/websites/{website_id}/mysql-dbs`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newMySQLDB` | `NewMySQLDB` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewMySQLDB;

$newMySQLDB = new NewMySQLDB();
$newMySQLDB->name = 'example';

$result = $enhance->mysql->createWebsiteMySQLDB('website-id', $newMySQLDB);
```

## createWebsiteMySQLUser

Create website MySQL database user

`POST /orgs/{org_id}/websites/{website_id}/mysql-users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newMySQLUser` | `NewMySQLUser` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewMySQLUser;
use GoSuccess\Enhance\Enum\MySQLAuthPlugin;

$newMySQLUser = new NewMySQLUser();
$newMySQLUser->username = 'example';
$newMySQLUser->password = 's3cret';
$newMySQLUser->authPlugin = MySQLAuthPlugin::CachingSha2Password;

$result = $enhance->mysql->createWebsiteMySQLUser('website-id', $newMySQLUser);
```

## createWebsiteMySQLUserAccessHosts

Create website MySQL database user access hosts

`POST /orgs/{org_id}/websites/{website_id}/mysql-users/{username}/access-hosts`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$mySQLUserAccessHosts` | `MySQLUserAccessHosts` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\MySQLUserAccessHosts;

$mySQLUserAccessHosts = new MySQLUserAccessHosts();

$result = $enhance->mysql->createWebsiteMySQLUserAccessHosts('website-id', 'example', $mySQLUserAccessHosts);
```

## deleteWebsiteMySQLDB

Delete website MySQL database

`DELETE /orgs/{org_id}/websites/{website_id}/mysql-dbs/{db_name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$dbName` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->mysql->deleteWebsiteMySQLDB('website-id', 'example');
```

## deleteWebsiteMySQLUser

Delete website MySQL database user

`DELETE /orgs/{org_id}/websites/{website_id}/mysql-users/{username}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->mysql->deleteWebsiteMySQLUser('website-id', 'example');
```

## deleteWebsiteMySQLUserAccessHosts

Delete website MySQL database user access hosts

`DELETE /orgs/{org_id}/websites/{website_id}/mysql-users/{username}/access-hosts`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$mySQLUserAccessHosts` | `MySQLUserAccessHosts` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\MySQLUserAccessHosts;

$mySQLUserAccessHosts = new MySQLUserAccessHosts();

$result = $enhance->mysql->deleteWebsiteMySQLUserAccessHosts('website-id', 'example', $mySQLUserAccessHosts);
```

## downloadSql

Takes a backup of given database and returns it gziped

`GET /orgs/{org_id}/websites/{website_id}/mysql-dbs/{db_name}/sql`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$dbName` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->mysql->downloadSql('website-id', 'example');
```

## getPhpMyAdminSSOUrl

Get phpMyAdmin SSO URL

`GET /orgs/{org_id}/websites/{website_id}/mysql-dbs/{db_name}/sso`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$dbName` | `string` | yes |
| `$shouldRedirect` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->mysql->getPhpMyAdminSSOUrl('website-id', 'example');
```

## getPhpMyAdminWebsiteSSOUrl

Get phpMyAdmin SSO URL (per website)

`GET /orgs/{org_id}/websites/{website_id}/phpmyadmin`

Fetches a single sign-on URL to access phpMyAdmin for this website without the
need to log in.

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$shouldRedirect` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->mysql->getPhpMyAdminWebsiteSSOUrl('website-id');
```

## getWebsiteMySQLDBs

Get website MySQL databases

`GET /orgs/{org_id}/websites/{website_id}/mysql-dbs`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->mysql->getWebsiteMySQLDBs('website-id');
```

## getWebsiteMySQLUsers

Get website MySQL database users

`GET /orgs/{org_id}/websites/{website_id}/mysql-users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->mysql->getWebsiteMySQLUsers('website-id');
```

## setWebsiteMySQLUserPrivileges

Create website MySQL database user privileges

`PUT /orgs/{org_id}/websites/{website_id}/mysql-users/{username}/privileges`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$mySQLUserGrants` | `MySQLUserGrants` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\MySQLUserGrants;

$mySQLUserGrants = new MySQLUserGrants();
$mySQLUserGrants->dbName = 'example';

$result = $enhance->mysql->setWebsiteMySQLUserPrivileges('website-id', 'example', $mySQLUserGrants);
```

## updateWebsiteMySQLUser

Update website MySQL database user

`PUT /orgs/{org_id}/websites/{website_id}/mysql-users/{username}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$mySQLUserUpdate` | `MySQLUserUpdate` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\MySQLUserUpdate;

$mySQLUserUpdate = new MySQLUserUpdate();
$mySQLUserUpdate->password = 's3cret';

$result = $enhance->mysql->updateWebsiteMySQLUser('website-id', 'example', $mySQLUserUpdate);
```

## uploadSql

Uploads sql file and executes it against db

`POST /v2/websites/{websiteId}/mysql/{db_id}/sql`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$dbId` | `string` | yes |
| `$formData` | `?array` | no |
| `$force` | `?bool` | no |

```php
$result = $enhance->mysql->uploadSql('website-id', 'db-id');
```

