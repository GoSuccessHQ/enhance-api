# WordpressResource

Accessed via `$enhance->wordpress`.

| Method | Route |
| ------ | ----- |
| [`activateWordpressTheme`](#activatewordpresstheme) | `POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}/activate` |
| [`createWordpressUser`](#createwordpressuser) | `POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users` |
| [`deleteWordpressPlugin`](#deletewordpressplugin) | `DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins/{plugin}` |
| [`deleteWordpressTheme`](#deletewordpresstheme) | `DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}` |
| [`deleteWordpressUser`](#deletewordpressuser) | `DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/{user_id}` |
| [`getDefaultWpSsoUser`](#getdefaultwpssouser) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/default` |
| [`getWordPressMaintenanceMode`](#getwordpressmaintenancemode) | `GET /v2/apps/{app_id}/wordpress/maintenance-mode` |
| [`getWordPressSiteurl`](#getwordpresssiteurl) | `GET /v2/apps/{app_id}/wordpress/url` |
| [`getWordpressAppVersion`](#getwordpressappversion) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/version` |
| [`getWordpressConfig`](#getwordpressconfig) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/wp-config/{wp_option}` |
| [`getWordpressInfo`](#getwordpressinfo) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/info` |
| [`getWordpressInstallations`](#getwordpressinstallations) | `GET /orgs/{org_id}/websites/{website_id}/apps/wordpress` |
| [`getWordpressLatestVersion`](#getwordpresslatestversion) | `GET /utils/wordpress/latest` |
| [`getWordpressPlugins`](#getwordpressplugins) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins` |
| [`getWordpressSettings`](#getwordpresssettings) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress` |
| [`getWordpressThemes`](#getwordpressthemes) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes` |
| [`getWordpressUserSsoUrl`](#getwordpressuserssourl) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/{user_id}/sso` |
| [`getWordpressUsers`](#getwordpressusers) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users` |
| [`installWordpressPlugin`](#installwordpressplugin) | `POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins` |
| [`installWordpressTheme`](#installwordpresstheme) | `POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes` |
| [`setDefaultWpSsoUser`](#setdefaultwpssouser) | `PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/default` |
| [`setWordPressMaintenanceMode`](#setwordpressmaintenancemode) | `PUT /v2/apps/{app_id}/wordpress/maintenance-mode` |
| [`setWordPressSiteurl`](#setwordpresssiteurl) | `PUT /v2/apps/{app_id}/wordpress/url` |
| [`setWordpressConfig`](#setwordpressconfig) | `PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/wp-config` |
| [`setWordpressThemeAutoUpdateStatus`](#setwordpressthemeautoupdatestatus) | `PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}/auto_update` |
| [`updateWordpressAppVersion`](#updatewordpressappversion) | `PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/version` |
| [`updateWordpressPluginSettings`](#updatewordpresspluginsettings) | `PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins/{plugin}` |
| [`updateWordpressPluginToLatest`](#updatewordpressplugintolatest) | `PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins/{plugin}/version` |
| [`updateWordpressSettings`](#updatewordpresssettings) | `PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress` |
| [`updateWordpressTheme`](#updatewordpresstheme) | `POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}/update` |
| [`updateWordpressUser`](#updatewordpressuser) | `PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/{user_id}` |

## activateWordpressTheme

Activate a WordPress theme

`POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}/activate`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$theme` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->activateWordpressTheme('website-id', 'app-id', 'example');
```

## createWordpressUser

Create website WordPress user

`POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$newWpUser` | `NewWpUser` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewWpUser;

$newWpUser = new NewWpUser();
$newWpUser->login = 'example';
$newWpUser->name = 'example';
$newWpUser->password = 's3cret';
// ... set further properties as needed

$result = $enhance->wordpress->createWordpressUser('website-id', 'app-id', $newWpUser);
```

## deleteWordpressPlugin

Delete website WordPress plugin

`DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins/{plugin}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$plugin` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->deleteWordpressPlugin('website-id', 'app-id', 'example');
```

## deleteWordpressTheme

Delete a WordPress theme

`DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$theme` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->deleteWordpressTheme('website-id', 'app-id', 'example');
```

## deleteWordpressUser

Delete WordPress user

`DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/{user_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$userId` | `int` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->deleteWordpressUser('website-id', 'app-id', 123);
```

## getDefaultWpSsoUser

Return previously set default Wordpress SSO user. If WP users exist but none were set to be default, returns 404.

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/default`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getDefaultWpSsoUser('website-id', 'app-id');
```

## getWordPressMaintenanceMode

Gets the MaintenanceMode for a WordPress installation

`GET /v2/apps/{app_id}/wordpress/maintenance-mode`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$appId` | `string` | yes |

```php
$result = $enhance->wordpress->getWordPressMaintenanceMode('app-id');
```

## getWordPressSiteurl

Fetches the site URL for a WordPress installation

`GET /v2/apps/{app_id}/wordpress/url`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$appId` | `string` | yes |

```php
$result = $enhance->wordpress->getWordPressSiteurl('app-id');
```

## getWordpressAppVersion

Get WordPress version

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/version`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getWordpressAppVersion('website-id', 'app-id');
```

## getWordpressConfig

Get the WP config value for a given option

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/wp-config/{wp_option}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$wpOption` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getWordpressConfig('website-id', 'app-id', 'example');
```

## getWordpressInfo

Get WordPress installation info

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/info`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getWordpressInfo('website-id', 'app-id');
```

## getWordpressInstallations

Trigger discovery of WP installations

`GET /orgs/{org_id}/websites/{website_id}/apps/wordpress`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getWordpressInstallations('website-id');
```

## getWordpressLatestVersion

Get WordPress latest available version

`GET /utils/wordpress/latest`

```php
$result = $enhance->wordpress->getWordpressLatestVersion();
```

## getWordpressPlugins

Get website WordPress plugins

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$refreshCache` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getWordpressPlugins('website-id', 'app-id');
```

## getWordpressSettings

Get Wordpress application settings

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getWordpressSettings('website-id', 'app-id');
```

## getWordpressThemes

Get website WordPress themes

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$refreshCache` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getWordpressThemes('website-id', 'app-id');
```

## getWordpressUserSsoUrl

Get SSO URL for a WP user

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/{user_id}/sso`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$userId` | `int` | yes |
| `$shouldRedirect` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getWordpressUserSsoUrl('website-id', 'app-id', 123);
```

## getWordpressUsers

Returns the users of this wordpress app.

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->getWordpressUsers('website-id', 'app-id');
```

## installWordpressPlugin

Install a plugin

`POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$installWpPlugin` | `InstallWpPlugin` | yes |
| `$refreshCache` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\InstallWpPlugin;

$installWpPlugin = new InstallWpPlugin();
$installWpPlugin->pluginName = 'example';

$result = $enhance->wordpress->installWordpressPlugin('website-id', 'app-id', $installWpPlugin);
```

## installWordpressTheme

Install a WordPress theme

`POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$installWpThemeRequest` | `InstallWpThemeRequest` | yes |
| `$refreshCache` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\InstallWpThemeRequest;

$installWpThemeRequest = new InstallWpThemeRequest();
$installWpThemeRequest->name = 'example';
$installWpThemeRequest->activate = true;

$result = $enhance->wordpress->installWordpressTheme('website-id', 'app-id', $installWpThemeRequest);
```

## setDefaultWpSsoUser

Set WP user as the default SSO user for that website.

`PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/default`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$body` | `mixed` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->setDefaultWpSsoUser('website-id', 'app-id', null);
```

## setWordPressMaintenanceMode

Sets the MaintenanceMode for a WordPress installation

`PUT /v2/apps/{app_id}/wordpress/maintenance-mode`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$appId` | `string` | yes |
| `$value` | `MaintenanceMode` | yes |

```php
use GoSuccess\Enhance\Enum\MaintenanceMode;

$result = $enhance->wordpress->setWordPressMaintenanceMode('app-id', MaintenanceMode::Activate);
```

## setWordPressSiteurl

Sets the site URL for a WordPress installation

`PUT /v2/apps/{app_id}/wordpress/url`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$appId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->wordpress->setWordPressSiteurl('app-id', 'example');
```

## setWordpressConfig

Set a single value of a wp-config.php entry.

`PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/wp-config`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$body` | `mixed` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->setWordpressConfig('website-id', 'app-id', null);
```

## setWordpressThemeAutoUpdateStatus

Set WordPress theme auto-update status

`PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}/auto_update`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$theme` | `string` | yes |
| `$value` | `?bool` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->setWordpressThemeAutoUpdateStatus('website-id', 'app-id', 'example', true);
```

## updateWordpressAppVersion

Update website WP app to specific version or latest

`PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/version`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->updateWordpressAppVersion('website-id', 'app-id');
```

## updateWordpressPluginSettings

Updates website WordPress plugin settings

`PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins/{plugin}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$plugin` | `string` | yes |
| `$updateWpPlugin` | `UpdateWpPlugin` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateWpPlugin;
use GoSuccess\Enhance\Enum\WPPluginAutoUpdateStatus;
use GoSuccess\Enhance\Enum\WPPluginStatus;

$updateWpPlugin = new UpdateWpPlugin();
$updateWpPlugin->status = WPPluginStatus::Active;
$updateWpPlugin->autoUpdate = WPPluginAutoUpdateStatus::Enabled;

$result = $enhance->wordpress->updateWordpressPluginSettings('website-id', 'app-id', 'example', $updateWpPlugin);
```

## updateWordpressPluginToLatest

Updates website WordPress plugin to latest version

`PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/plugins/{plugin}/version`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$plugin` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->updateWordpressPluginToLatest('website-id', 'app-id', 'example');
```

## updateWordpressSettings

Update Wordpress app settings

`PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$updateWpSettings` | `UpdateWpSettings` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateWpSettings;
use GoSuccess\Enhance\Enum\WPAutoUpdateCore;

$updateWpSettings = new UpdateWpSettings();
$updateWpSettings->autoUpdateCore = WPAutoUpdateCore::Major;
$updateWpSettings->disallowNonWpPhp = true;

$result = $enhance->wordpress->updateWordpressSettings('website-id', 'app-id', $updateWpSettings);
```

## updateWordpressTheme

Update a WordPress theme

`POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/themes/{theme}/update`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$theme` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->wordpress->updateWordpressTheme('website-id', 'app-id', 'example');
```

## updateWordpressUser

Update WordPress user

`PATCH /orgs/{org_id}/websites/{website_id}/apps/{app_id}/wordpress/users/{user_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$userId` | `int` | yes |
| `$updateWpUser` | `UpdateWpUser` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateWpUser;

$updateWpUser = new UpdateWpUser();
$updateWpUser->password = 's3cret';
$updateWpUser->name = 'example';
$updateWpUser->email = 'user@example.com';

$result = $enhance->wordpress->updateWordpressUser('website-id', 'app-id', 123, $updateWpUser);
```

