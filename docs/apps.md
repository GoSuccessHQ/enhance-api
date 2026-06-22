# AppsResource

Accessed via `$enhance->apps`.

| Method | Route |
| ------ | ----- |
| [`createWebsiteApp`](#createwebsiteapp) | `POST /orgs/{org_id}/websites/{website_id}/apps` |
| [`createWebsitePersistentApp`](#createwebsitepersistentapp) | `POST /websites/{website_id}/apps/persistent` |
| [`deleteWebsiteApp`](#deletewebsiteapp) | `DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}` |
| [`deleteWebsitePersistentApp`](#deletewebsitepersistentapp) | `DELETE /websites/{website_id}/apps/persistent/{app_id}` |
| [`getGlobalInstallableApps`](#getglobalinstallableapps) | `GET /utils/installable-apps` |
| [`getInstallableApps`](#getinstallableapps) | `GET /orgs/{org_id}/subscriptions/{subscription_id}/installable-apps` |
| [`getPossibleNodeVersions`](#getpossiblenodeversions) | `GET /websites/{website_id}/apps/node/possible_versions` |
| [`getWebsiteApps`](#getwebsiteapps) | `GET /orgs/{org_id}/websites/{website_id}/apps` |
| [`getWebsitePersistentAppLog`](#getwebsitepersistentapplog) | `GET /websites/{website_id}/apps/persistent/{app_id}` |
| [`getWebsitePersistentApps`](#getwebsitepersistentapps) | `GET /websites/{website_id}/apps/persistent` |
| [`installNodeVersion`](#installnodeversion) | `POST /websites/{website_id}/apps/node/versions` |
| [`installNvm`](#installnvm) | `POST /websites/{website_id}/apps/node` |
| [`listInstalledNodeVersions`](#listinstallednodeversions) | `GET /websites/{website_id}/apps/node/versions` |
| [`setDefaultNodeVersion`](#setdefaultnodeversion) | `PUT /websites/{website_id}/apps/node/versions/default` |
| [`updateWebsitePersistentApp`](#updatewebsitepersistentapp) | `PATCH /websites/{website_id}/apps/persistent/{app_id}` |

## createWebsiteApp

Create website applications

`POST /orgs/{org_id}/websites/{website_id}/apps`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newWebsiteApp` | `NewWebsiteApp` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewWebsiteApp;
use GoSuccess\Enhance\Enum\WebsiteAppKind;

$newWebsiteApp = new NewWebsiteApp();
$newWebsiteApp->app = WebsiteAppKind::Wordpress;
$newWebsiteApp->version = 'example';
$newWebsiteApp->path = 'example';
// ... set further properties as needed

$result = $enhance->apps->createWebsiteApp('website-id', $newWebsiteApp);
```

## createWebsitePersistentApp

Create a persistent application

`POST /websites/{website_id}/apps/persistent`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$persistentApp` | `PersistentApp` | yes |

```php
use GoSuccess\Enhance\DTO\PersistentApp;
use GoSuccess\Enhance\Enum\PersistentAppStartMode;

$persistentApp = new PersistentApp();
$persistentApp->startMode = PersistentAppStartMode::Automatic;
$persistentApp->command = 'example';
$persistentApp->workingDirectory = 'example';
// ... set further properties as needed

$result = $enhance->apps->createWebsitePersistentApp('website-id', $persistentApp);
```

## deleteWebsiteApp

Delete website app

`DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$backupBeforeOperation` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->apps->deleteWebsiteApp('website-id', 'app-id');
```

## deleteWebsitePersistentApp

Delete a persistent app

`DELETE /websites/{website_id}/apps/persistent/{app_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |

```php
$result = $enhance->apps->deleteWebsitePersistentApp('website-id', 'app-id');
```

## getGlobalInstallableApps

Get all installable applications

`GET /utils/installable-apps`

```php
$result = $enhance->apps->getGlobalInstallableApps();
```

## getInstallableApps

Get installable website applications

`GET /orgs/{org_id}/subscriptions/{subscription_id}/installable-apps`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$subscriptionId` | `float` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->apps->getInstallableApps(1.0);
```

## getPossibleNodeVersions

Get possible versions of node to install from nvm

`GET /websites/{website_id}/apps/node/possible_versions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->apps->getPossibleNodeVersions('website-id');
```

## getWebsiteApps

Get website applications

`GET /orgs/{org_id}/websites/{website_id}/apps`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->apps->getWebsiteApps('website-id');
```

## getWebsitePersistentAppLog

Get the log for a persistent app

`GET /websites/{website_id}/apps/persistent/{app_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |

```php
$result = $enhance->apps->getWebsitePersistentAppLog('website-id', 'app-id');
```

## getWebsitePersistentApps

Get website persistent applications

`GET /websites/{website_id}/apps/persistent`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->apps->getWebsitePersistentApps('website-id');
```

## installNodeVersion

Install a specific version of Node with NVM

`POST /websites/{website_id}/apps/node/versions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->apps->installNodeVersion('website-id', 'example');
```

## installNvm

Install nvm and default stable node to this website

`POST /websites/{website_id}/apps/node`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->apps->installNvm('website-id');
```

## listInstalledNodeVersions

List installed Node versions with NVM

`GET /websites/{website_id}/apps/node/versions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->apps->listInstalledNodeVersions('website-id');
```

## setDefaultNodeVersion

Set default node version

`PUT /websites/{website_id}/apps/node/versions/default`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->apps->setDefaultNodeVersion('website-id', 'example');
```

## updateWebsitePersistentApp

Update a persistent application

`PATCH /websites/{website_id}/apps/persistent/{app_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$updatePersistentApp` | `UpdatePersistentApp` | yes |

```php
use GoSuccess\Enhance\DTO\UpdatePersistentApp;
use GoSuccess\Enhance\Enum\PersistentAppStartMode;

$updatePersistentApp = new UpdatePersistentApp();
$updatePersistentApp->startMode = PersistentAppStartMode::Automatic;
$updatePersistentApp->command = 'example';
$updatePersistentApp->workingDirectory = 'example';
// ... set further properties as needed

$result = $enhance->apps->updateWebsitePersistentApp('website-id', 'app-id', $updatePersistentApp);
```

