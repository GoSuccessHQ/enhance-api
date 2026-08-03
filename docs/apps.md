# AppsResource

Accessed via `$enhance->apps`.

| Method | Route |
| ------ | ----- |
| [`approveOpenclawDevice`](#approveopenclawdevice) | `PUT /websites/{website_id}/openclaw/approve` |
| [`createWebsiteApp`](#createwebsiteapp) | `POST /orgs/{org_id}/websites/{website_id}/apps` |
| [`createWebsitePersistentApp`](#createwebsitepersistentapp) | `POST /websites/{website_id}/apps/persistent` |
| [`deleteWebsiteApp`](#deletewebsiteapp) | `DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}` |
| [`deleteWebsitePersistentApp`](#deletewebsitepersistentapp) | `DELETE /websites/{website_id}/apps/persistent/{app_id}` |
| [`getGlobalInstallableApps`](#getglobalinstallableapps) | `GET /utils/installable-apps` |
| [`getInstallableApps`](#getinstallableapps) | `GET /orgs/{org_id}/subscriptions/{subscription_id}/installable-apps` |
| [`getOpenclawProviderKeys`](#getopenclawproviderkeys) | `GET /websites/{website_id}/openclaw/provider_keys` |
| [`getPossibleNodeVersions`](#getpossiblenodeversions) | `GET /websites/{website_id}/apps/node/possible_versions` |
| [`getWebsiteApps`](#getwebsiteapps) | `GET /orgs/{org_id}/websites/{website_id}/apps` |
| [`getWebsiteOpenclawInfo`](#getwebsiteopenclawinfo) | `GET /websites/{website_id}/openclaw/info` |
| [`getWebsitePersistentAppLog`](#getwebsitepersistentapplog) | `GET /websites/{website_id}/apps/persistent/{app_id}` |
| [`getWebsitePersistentApps`](#getwebsitepersistentapps) | `GET /websites/{website_id}/apps/persistent` |
| [`installNodeVersion`](#installnodeversion) | `POST /websites/{website_id}/apps/node/versions` |
| [`installNvm`](#installnvm) | `POST /websites/{website_id}/apps/node` |
| [`listInstalledNodeVersions`](#listinstallednodeversions) | `GET /websites/{website_id}/apps/node/versions` |
| [`openclawDeviceList`](#openclawdevicelist) | `GET /websites/{website_id}/openclaw/devices` |
| [`openclawSso`](#openclawsso) | `GET /websites/{website_id}/openclaw/sso` |
| [`rotateOpenclawAuthToken`](#rotateopenclawauthtoken) | `POST /websites/{website_id}/openclaw/rotate_token` |
| [`setDefaultNodeVersion`](#setdefaultnodeversion) | `PUT /websites/{website_id}/apps/node/versions/default` |
| [`setOpenclawDeviceAuth`](#setopenclawdeviceauth) | `PUT /websites/{website_id}/openclaw/device_auth_enabled` |
| [`setOpenclawProviderKeys`](#setopenclawproviderkeys) | `PUT /websites/{website_id}/openclaw/provider_keys` |
| [`updateWebsitePersistentApp`](#updatewebsitepersistentapp) | `PATCH /websites/{website_id}/apps/persistent/{app_id}` |

## approveOpenclawDevice

Approve a device request

`PUT /websites/{website_id}/openclaw/approve`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `string` | yes |

```php
$result = $enhance->apps->approveOpenclawDevice('website-id', 'device-request-id');
```

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

## getOpenclawProviderKeys

List configured provider keys

`GET /websites/{website_id}/openclaw/provider_keys`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->apps->getOpenclawProviderKeys('website-id');
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

## getWebsiteOpenclawInfo

Get Openclaw info (if installed)

`GET /websites/{website_id}/openclaw/info`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->apps->getWebsiteOpenclawInfo('website-id');
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

## openclawDeviceList

List Openclaw devices

`GET /websites/{website_id}/openclaw/devices`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->apps->openclawDeviceList('website-id');
```

## openclawSso

Generate SSO URL for Openclaw and 302 redirect

`GET /websites/{website_id}/openclaw/sso`

The redirect is not followed; the generated SSO URL is returned from the
response's `Location` header.

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$ssoUrl = $enhance->apps->openclawSso('website-id');
```

## rotateOpenclawAuthToken

Rotate the auth token for Openclaw to a new random token

`POST /websites/{website_id}/openclaw/rotate_token`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$newToken = $enhance->apps->rotateOpenclawAuthToken('website-id');
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

## setOpenclawDeviceAuth

Set device auth for Openclaw installation

`PUT /websites/{website_id}/openclaw/device_auth_enabled`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `bool` | yes |

```php
$result = $enhance->apps->setOpenclawDeviceAuth('website-id', true);
```

## setOpenclawProviderKeys

Set configured provider keys

`PUT /websites/{website_id}/openclaw/provider_keys`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$openclawProviderKeys` | `OpenclawProviderKeys` | yes |

```php
use GoSuccess\Enhance\DTO\OpenclawProviderKeys;

$openclawProviderKeys = new OpenclawProviderKeys();
$openclawProviderKeys->anthropic = 'example';
// ... set further properties as needed

$result = $enhance->apps->setOpenclawProviderKeys('website-id', $openclawProviderKeys);
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

