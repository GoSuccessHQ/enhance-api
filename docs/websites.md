# WebsitesResource

Accessed via `$enhance->websites`.

| Method | Route |
| ------ | ----- |
| [`addDomainNginxFastCgiExcludedPath`](#adddomainnginxfastcgiexcludedpath) | `POST /v2/domains/{domain_id}/nginx_fastcgi_excluded_paths` |
| [`authorizeWebsiteSshKey`](#authorizewebsitesshkey) | `POST /orgs/{org_id}/websites/{website_id}/ssh/keys` |
| [`authorizeWebsiteSshPassword`](#authorizewebsitesshpassword) | `POST /orgs/{org_id}/websites/{website_id}/ssh/password` |
| [`clearDomainNginxFastCgi`](#cleardomainnginxfastcgi) | `DELETE /v2/domains/{domain_id}/nginx_fastcgi` |
| [`cloneWebsite`](#clonewebsite) | `POST /orgs/{org_id}/websites/clone` |
| [`createPreviewDomain`](#createpreviewdomain) | `POST /orgs/{org_id}/websites/{website_id}/preview` |
| [`createWebsite`](#createwebsite) | `POST /orgs/{org_id}/websites` |
| [`createWebsiteMappedDomain`](#createwebsitemappeddomain) | `POST /orgs/{org_id}/websites/{website_id}/domains` |
| [`deleteDomainNginxFastCgiExcludedPath`](#deletedomainnginxfastcgiexcludedpath) | `DELETE /v2/domains/{domain_id}/nginx_fastcgi_excluded_paths` |
| [`deleteDomainWebserverRewrite`](#deletedomainwebserverrewrite) | `DELETE /v2/domains/{domain_id}/webserver_rewrites` |
| [`deleteUserCrontab`](#deleteusercrontab) | `DELETE /orgs/{org_id}/websites/{website_id}/crontab` |
| [`deleteWebsite`](#deletewebsite) | `DELETE /orgs/{org_id}/websites/{website_id}` |
| [`deleteWebsiteDomainMapping`](#deletewebsitedomainmapping) | `DELETE /orgs/{org_id}/websites/{website_id}/domains/{domain_id}` |
| [`deleteWebsiteSetting`](#deletewebsitesetting) | `DELETE /orgs/{org_id}/websites/{website_id}/settings/{setting_kind}/{setting_key}` |
| [`deleteWebsites`](#deletewebsites) | `DELETE /orgs/{org_id}/websites` |
| [`disableWebsitePhpExtension`](#disablewebsitephpextension) | `DELETE /websites/{website_id}/php_extensions` |
| [`enableWebsitePhpExtension`](#enablewebsitephpextension) | `POST /websites/{website_id}/php_extensions` |
| [`getBuiltInPhpExtensions`](#getbuiltinphpextensions) | `GET /websites/{website_id}/built_in_php_extensions` |
| [`getContainerCronEnabledStatus`](#getcontainercronenabledstatus) | `GET /websites/{website_id}/container_cron_enabled` |
| [`getDomainNginxFastCgi`](#getdomainnginxfastcgi) | `GET /v2/domains/{domain_id}/nginx_fastcgi` |
| [`getDomainNginxFastCgiExcludedPaths`](#getdomainnginxfastcgiexcludedpaths) | `GET /v2/domains/{domain_id}/nginx_fastcgi_excluded_paths` |
| [`getDomainWebserverRewrites`](#getdomainwebserverrewrites) | `GET /v2/domains/{domain_id}/webserver_rewrites` |
| [`getScreenshotTimestamp`](#getscreenshottimestamp) | `GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/screenshot/timestamp` |
| [`getSiteAccessToken`](#getsiteaccesstoken) | `POST /orgs/{org_id}/websites/{website_id}/access-tokens` |
| [`getUserCrontab`](#getusercrontab) | `GET /orgs/{org_id}/websites/{website_id}/crontab` |
| [`getWebsite`](#getwebsite) | `GET /orgs/{org_id}/websites/{website_id}` |
| [`getWebsiteAvailablePhpExtensions`](#getwebsiteavailablephpextensions) | `GET /websites/{website_id}/available_php_extensions` |
| [`getWebsiteBackupStatus`](#getwebsitebackupstatus) | `GET /orgs/{org_id}/websites/{website_id}/status/backup` |
| [`getWebsiteBackupsDisabledStatus`](#getwebsitebackupsdisabledstatus) | `GET /websites/{website_id}/backups_disabled` |
| [`getWebsiteCgroupLimits`](#getwebsitecgrouplimits) | `GET /orgs/{org_id}/websites/{website_id}/cgroup_limits` |
| [`getWebsiteClone`](#getwebsiteclone) | `GET /orgs/{org_id}/websites/clone/{clone_id}` |
| [`getWebsiteCloneLog`](#getwebsiteclonelog) | `GET /orgs/{org_id}/websites/clone/{clone_id}/log` |
| [`getWebsiteClones`](#getwebsiteclones) | `GET /orgs/{org_id}/websites/clone` |
| [`getWebsiteContainerIp`](#getwebsitecontainerip) | `GET /websites/{website_id}/container_ip` |
| [`getWebsiteDomainDnsQuery`](#getwebsitedomaindnsquery) | `GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-query` |
| [`getWebsiteDomainMapping`](#getwebsitedomainmapping) | `GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}` |
| [`getWebsiteDomainMappingDnsStatus`](#getwebsitedomainmappingdnsstatus) | `GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-status` |
| [`getWebsiteDomainMappings`](#getwebsitedomainmappings) | `GET /orgs/{org_id}/websites/{website_id}/domains` |
| [`getWebsiteEnabledPhpExtensions`](#getwebsiteenabledphpextensions) | `GET /websites/{website_id}/php_extensions` |
| [`getWebsiteFsQuotaLimits`](#getwebsitefsquotalimits) | `GET /orgs/{org_id}/websites/{website_id}/fs_quota_limits` |
| [`getWebsiteHtaccessIpsRule`](#getwebsitehtaccessipsrule) | `GET /orgs/{org_id}/websites/{website_id}/htaccess/ips` |
| [`getWebsiteHtaccessRewrites`](#getwebsitehtaccessrewrites) | `GET /orgs/{org_id}/websites/{website_id}/htaccess` |
| [`getWebsiteIoncubeStatus`](#getwebsiteioncubestatus) | `GET /v2/websites/{website_id}/ioncube` |
| [`getWebsiteLsphpSettings`](#getwebsitelsphpsettings) | `GET /websites/{website_id}/lsphp_settings` |
| [`getWebsitePhpErrorLog`](#getwebsitephperrorlog) | `GET /websites/{website_id}/php_error_log` |
| [`getWebsiteRedisState`](#getwebsiteredisstate) | `GET /v2/websites/{website_id}/redis` |
| [`getWebsiteServerDomains`](#getwebsiteserverdomains) | `GET /orgs/{org_id}/websites/{website_id}/server_domains` |
| [`getWebsiteSetting`](#getwebsitesetting) | `GET /orgs/{org_id}/websites/{website_id}/settings/{setting_kind}` |
| [`getWebsiteSshKeys`](#getwebsitesshkeys) | `GET /orgs/{org_id}/websites/{website_id}/ssh/keys` |
| [`getWebsiteWebserverKind`](#getwebsitewebserverkind) | `GET /v2/websites/{website_id}/webserver_kind` |
| [`getWebsites`](#getwebsites) | `GET /orgs/{org_id}/websites` |
| [`pushWebsiteLive`](#pushwebsitelive) | `POST /orgs/{org_id}/websites/{website_id}/push-live` |
| [`restartWebsitePhp`](#restartwebsitephp) | `POST /v2/websites/{website_id}/restart_php` |
| [`setContainerCronEnabledStatus`](#setcontainercronenabledstatus) | `PUT /websites/{website_id}/container_cron_enabled` |
| [`setDomainNginxFastCgi`](#setdomainnginxfastcgi) | `PUT /v2/domains/{domain_id}/nginx_fastcgi` |
| [`setDomainWebserverRewrite`](#setdomainwebserverrewrite) | `PUT /v2/domains/{domain_id}/webserver_rewrites` |
| [`setWebsiteBackupsDisabledStatus`](#setwebsitebackupsdisabledstatus) | `PUT /websites/{website_id}/backups_disabled` |
| [`setWebsiteCgroupLimits`](#setwebsitecgrouplimits) | `PUT /orgs/{org_id}/websites/{website_id}/cgroup_limits` |
| [`setWebsiteFsQuotaLimits`](#setwebsitefsquotalimits) | `PUT /orgs/{org_id}/websites/{website_id}/fs_quota_limits` |
| [`setWebsiteIoncubeStatus`](#setwebsiteioncubestatus) | `PUT /v2/websites/{website_id}/ioncube` |
| [`setWebsiteLsphpSettings`](#setwebsitelsphpsettings) | `PUT /websites/{website_id}/lsphp_settings` |
| [`setWebsiteRedisState`](#setwebsiteredisstate) | `PUT /v2/websites/{website_id}/redis` |
| [`setWebsiteSetting`](#setwebsitesetting) | `PUT /orgs/{org_id}/websites/{website_id}/settings/{setting_kind}/{setting_key}` |
| [`takeScreenshot`](#takescreenshot) | `POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/screenshot/take` |
| [`unauthorizeWebsiteSshKey`](#unauthorizewebsitesshkey) | `DELETE /orgs/{org_id}/websites/{website_id}/ssh/keys/{key_id}` |
| [`updateUserCrontab`](#updateusercrontab) | `PATCH /orgs/{org_id}/websites/{website_id}/crontab` |
| [`updateWebsite`](#updatewebsite) | `PATCH /orgs/{org_id}/websites/{website_id}` |
| [`updateWebsiteDomainMapping`](#updatewebsitedomainmapping) | `PATCH /orgs/{org_id}/websites/{website_id}/domains/{domain_id}` |
| [`updateWebsiteHtaccessIpsRule`](#updatewebsitehtaccessipsrule) | `PUT /orgs/{org_id}/websites/{website_id}/htaccess/ips` |
| [`updateWebsiteHtaccessRewrites`](#updatewebsitehtaccessrewrites) | `PATCH /orgs/{org_id}/websites/{website_id}/htaccess` |
| [`updateWebsitePrimaryDomain`](#updatewebsiteprimarydomain) | `PUT /orgs/{org_id}/websites/{website_id}/domains/primary` |
| [`updateWebsiteSshKey`](#updatewebsitesshkey) | `PATCH /orgs/{org_id}/websites/{website_id}/ssh/keys/{key_id}` |
| [`validateWebsiteOperation`](#validatewebsiteoperation) | `POST /orgs/{org_id}/websites/{website_id}/validate-operation` |

## addDomainNginxFastCgiExcludedPath

Add Nginx FastCGI excluded path

`POST /v2/domains/{domain_id}/nginx_fastcgi_excluded_paths`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->websites->addDomainNginxFastCgiExcludedPath('example.com', 'example');
```

## authorizeWebsiteSshKey

Authorize a new SSH key.

`POST /orgs/{org_id}/websites/{website_id}/ssh/keys`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newSshKey` | `NewSshKey` | yes |
| `$sanitize` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewSshKey;

$newSshKey = new NewSshKey();
$newSshKey->value = 'example';
$newSshKey->name = 'example';

$result = $enhance->websites->authorizeWebsiteSshKey('website-id', $newSshKey);
```

## authorizeWebsiteSshPassword

Authorize a new SSH password for website.

`POST /orgs/{org_id}/websites/{website_id}/ssh/password`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newPassword` | `NewPassword` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewPassword;

$newPassword = new NewPassword();
$newPassword->newPassword = 's3cret';

$result = $enhance->websites->authorizeWebsiteSshPassword('website-id', $newPassword);
```

## clearDomainNginxFastCgi

Clear FastCGI cache for domain

`DELETE /v2/domains/{domain_id}/nginx_fastcgi`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->websites->clearDomainNginxFastCgi('example.com');
```

## cloneWebsite

Clone website or push live

`POST /orgs/{org_id}/websites/clone`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteCloneRequest` | `WebsiteCloneRequest` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\WebsiteCloneRequest;

$websiteCloneRequest = new WebsiteCloneRequest();
$websiteCloneRequest->runWpSearchReplace = true;
$websiteCloneRequest->sourceWebsiteId = 'sourceWebsite-id';
$websiteCloneRequest->destWebsiteId = 'destWebsite-id';
// ... set further properties as needed

$result = $enhance->websites->cloneWebsite($websiteCloneRequest);
```

## createPreviewDomain

Create a preview domain

`POST /orgs/{org_id}/websites/{website_id}/preview`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->createPreviewDomain('website-id');
```

## createWebsite

Create a new website or clone an existing one.

`POST /orgs/{org_id}/websites`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newWebsite` | `NewWebsite` | yes |
| `$kind` | `?WebsiteKind` | no |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewWebsite;

$newWebsite = new NewWebsite();
$newWebsite->domain = 'example.com';
$newWebsite->subscriptionId = 123;
$newWebsite->appServerId = 'appServer-id';
// ... set further properties as needed

$result = $enhance->websites->createWebsite($newWebsite);
```

## createWebsiteMappedDomain

Create website mapped domain

`POST /orgs/{org_id}/websites/{website_id}/domains`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newMappedDomain` | `NewMappedDomain` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewMappedDomain;
use GoSuccess\Enhance\Enum\DomainMappingKind;

$newMappedDomain = new NewMappedDomain();
$newMappedDomain->domain = 'example.com';
$newMappedDomain->documentRoot = 'example';
$newMappedDomain->kind = DomainMappingKind::Primary;

$result = $enhance->websites->createWebsiteMappedDomain('website-id', $newMappedDomain);
```

## deleteDomainNginxFastCgiExcludedPath

Delete Nginx FastCGI excluded path

`DELETE /v2/domains/{domain_id}/nginx_fastcgi_excluded_paths`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$path` | `?string` | no |

```php
$result = $enhance->websites->deleteDomainNginxFastCgiExcludedPath('example.com');
```

## deleteDomainWebserverRewrite

Delete web server rewrite

`DELETE /v2/domains/{domain_id}/webserver_rewrites`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$path` | `?string` | no |

```php
$result = $enhance->websites->deleteDomainWebserverRewrite('example.com');
```

## deleteUserCrontab

Delete user's crontab

`DELETE /orgs/{org_id}/websites/{website_id}/crontab`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->deleteUserCrontab('website-id');
```

## deleteWebsite

Delete website

`DELETE /orgs/{org_id}/websites/{website_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$force` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->deleteWebsite('website-id');
```

## deleteWebsiteDomainMapping

Delete website domain mapping

`DELETE /orgs/{org_id}/websites/{website_id}/domains/{domain_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->deleteWebsiteDomainMapping('website-id', 'example.com');
```

## deleteWebsiteSetting

Delete a single override setting

`DELETE /orgs/{org_id}/websites/{website_id}/settings/{setting_kind}/{setting_key}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$settingKind` | `SettingKind` | yes |
| `$settingKey` | `string` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\Enum\SettingKind;

$result = $enhance->websites->deleteWebsiteSetting('website-id', SettingKind::PhpIni, 'example');
```

## deleteWebsites

Delete websites

`DELETE /orgs/{org_id}/websites`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$uuidListing` | `UuidListing` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UuidListing;

$uuidListing = new UuidListing();

$result = $enhance->websites->deleteWebsites($uuidListing);
```

## disableWebsitePhpExtension

Disable a PHP extension

`DELETE /websites/{website_id}/php_extensions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `?string` | no |

```php
$result = $enhance->websites->disableWebsitePhpExtension('website-id');
```

## enableWebsitePhpExtension

Enable a PHP extension

`POST /websites/{website_id}/php_extensions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `?string` | no |

```php
$result = $enhance->websites->enableWebsitePhpExtension('website-id');
```

## getBuiltInPhpExtensions

Get a list of the PHP extensions compiled in to the currently selected version of PHP for this website

`GET /websites/{website_id}/built_in_php_extensions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getBuiltInPhpExtensions('website-id');
```

## getContainerCronEnabledStatus

Get container cron status for a website

`GET /websites/{website_id}/container_cron_enabled`

This setting controls whether or not a website can change its own crontab from
inside the container.

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getContainerCronEnabledStatus('website-id');
```

## getDomainNginxFastCgi

Get status of Nginx FastCGI enablement

`GET /v2/domains/{domain_id}/nginx_fastcgi`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->websites->getDomainNginxFastCgi('example.com');
```

## getDomainNginxFastCgiExcludedPaths

Get Nginx FastCGI excluded paths

`GET /v2/domains/{domain_id}/nginx_fastcgi_excluded_paths`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->websites->getDomainNginxFastCgiExcludedPaths('example.com');
```

## getDomainWebserverRewrites

Get web server rewrites for specified domain

`GET /v2/domains/{domain_id}/webserver_rewrites`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->websites->getDomainWebserverRewrites('example.com');
```

## getScreenshotTimestamp

Get last screeshot file's Timestamp

`GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/screenshot/timestamp`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getScreenshotTimestamp('website-id', 'example.com');
```

## getSiteAccessToken

Get an access token for the given website

`POST /orgs/{org_id}/websites/{website_id}/access-tokens`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getSiteAccessToken('website-id');
```

## getUserCrontab

Get user's crontab

`GET /orgs/{org_id}/websites/{website_id}/crontab`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getUserCrontab('website-id');
```

## getWebsite

Get website

`GET /orgs/{org_id}/websites/{website_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsite('website-id');
```

## getWebsiteAvailablePhpExtensions

Get available PHP extensions for a website

`GET /websites/{website_id}/available_php_extensions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getWebsiteAvailablePhpExtensions('website-id');
```

## getWebsiteBackupStatus

Get the status of an ongoing website backup operation

`GET /orgs/{org_id}/websites/{website_id}/status/backup`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteBackupStatus('website-id');
```

## getWebsiteBackupsDisabledStatus

Get backups disabled status on a website

`GET /websites/{website_id}/backups_disabled`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getWebsiteBackupsDisabledStatus('website-id');
```

## getWebsiteCgroupLimits

Get the active cgroup limits for a website

`GET /orgs/{org_id}/websites/{website_id}/cgroup_limits`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteCgroupLimits('website-id');
```

## getWebsiteClone

Get's detail about a single push live

`GET /orgs/{org_id}/websites/clone/{clone_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$cloneId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteClone('clone-id');
```

## getWebsiteCloneLog

Get the log for a given clone id..

`GET /orgs/{org_id}/websites/clone/{clone_id}/log`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$cloneId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteCloneLog('clone-id');
```

## getWebsiteClones

List website clones for given OrgId

`GET /orgs/{org_id}/websites/clone`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteClones();
```

## getWebsiteContainerIp

Get the container IP and host IP for this website

`GET /websites/{website_id}/container_ip`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getWebsiteContainerIp('website-id');
```

## getWebsiteDomainDnsQuery

Recursively query Dns servers for given domain

`GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-query`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$resolveDepth` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteDomainDnsQuery('website-id', 'example.com');
```

## getWebsiteDomainMapping

Returns website domain mapping

`GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteDomainMapping('website-id', 'example.com');
```

## getWebsiteDomainMappingDnsStatus

Returns website domain mapping DNS status

`GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteDomainMappingDnsStatus('website-id', 'example.com');
```

## getWebsiteDomainMappings

Get website's mapped domains

`GET /orgs/{org_id}/websites/{website_id}/domains`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$withSsl` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteDomainMappings('website-id');
```

## getWebsiteEnabledPhpExtensions

Get enabled PHP extensions

`GET /websites/{website_id}/php_extensions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getWebsiteEnabledPhpExtensions('website-id');
```

## getWebsiteFsQuotaLimits

Get the active FS quoa limits for a website

`GET /orgs/{org_id}/websites/{website_id}/fs_quota_limits`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteFsQuotaLimits('website-id');
```

## getWebsiteHtaccessIpsRule

Returns current rules of blocked/whitelisted IPs

`GET /orgs/{org_id}/websites/{website_id}/htaccess/ips`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteHtaccessIpsRule('website-id');
```

## getWebsiteHtaccessRewrites

Reads chains of rewrite rules

`GET /orgs/{org_id}/websites/{website_id}/htaccess`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteHtaccessRewrites('website-id');
```

## getWebsiteIoncubeStatus

Get ioncube status for an existing website

`GET /v2/websites/{website_id}/ioncube`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getWebsiteIoncubeStatus('website-id');
```

## getWebsiteLsphpSettings

Get the LSPHP settings for this website

`GET /websites/{website_id}/lsphp_settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getWebsiteLsphpSettings('website-id');
```

## getWebsitePhpErrorLog

Get last 256KB of PHP error log

`GET /websites/{website_id}/php_error_log`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getWebsitePhpErrorLog('website-id');
```

## getWebsiteRedisState

Get redis state for a website

`GET /v2/websites/{website_id}/redis`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getWebsiteRedisState('website-id');
```

## getWebsiteServerDomains

Fetch website server domains

`GET /orgs/{org_id}/websites/{website_id}/server_domains`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteServerDomains('website-id');
```

## getWebsiteSetting

Get the value for a particular setting

`GET /orgs/{org_id}/websites/{website_id}/settings/{setting_kind}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$settingKind` | `SettingKind` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\Enum\SettingKind;

$result = $enhance->websites->getWebsiteSetting('website-id', SettingKind::PhpIni);
```

## getWebsiteSshKeys

Get website's authorized SSH keys

`GET /orgs/{org_id}/websites/{website_id}/ssh/keys`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$sanitize` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsiteSshKeys('website-id');
```

## getWebsiteWebserverKind

Get web server kind for a given website

`GET /v2/websites/{website_id}/webserver_kind`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->getWebsiteWebserverKind('website-id');
```

## getWebsites

Get websites

`GET /orgs/{org_id}/websites`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortBy` | `?string` | no |
| `$sortOrder` | `?string` | no |
| `$search` | `?string` | no |
| `$recursion` | `?Recursion` | no |
| `$planId` | `?int` | no |
| `$subscriptionId` | `?int` | no |
| `$status` | `?WebsiteStatus` | no |
| `$isSuspended` | `?bool` | no |
| `$roles` | `?array` | no |
| `$servers` | `?array` | no |
| `$kind` | `?WebsiteKind` | no |
| `$showDeleted` | `?bool` | no |
| `$showAliases` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->getWebsites();
```

## pushWebsiteLive

Making a staging website live

`POST /orgs/{org_id}/websites/{website_id}/push-live`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->pushWebsiteLive('website-id');
```

## restartWebsitePhp

Restart PHP container for a website

`POST /v2/websites/{website_id}/restart_php`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->websites->restartWebsitePhp('website-id');
```

## setContainerCronEnabledStatus

Set container cron status on a website

`PUT /websites/{website_id}/container_cron_enabled`

This setting controls whether or not a website can change its own crontab from
inside the container.

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `bool` | yes |

```php
$result = $enhance->websites->setContainerCronEnabledStatus('website-id', true);
```

## setDomainNginxFastCgi

Set Nginx FastCGI enablement

`PUT /v2/domains/{domain_id}/nginx_fastcgi`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$value` | `?bool` | yes |

```php
$result = $enhance->websites->setDomainNginxFastCgi('example.com', true);
```

## setDomainWebserverRewrite

Set web server rewrite to file

`PUT /v2/domains/{domain_id}/webserver_rewrites`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$webServerRewrite` | `WebServerRewrite` | yes |

```php
use GoSuccess\Enhance\DTO\WebServerRewrite;

$webServerRewrite = new WebServerRewrite();
$webServerRewrite->path = 'example';
$webServerRewrite->destinationFile = 'example';

$result = $enhance->websites->setDomainWebserverRewrite('example.com', $webServerRewrite);
```

## setWebsiteBackupsDisabledStatus

Set backups disabled status on a website

`PUT /websites/{website_id}/backups_disabled`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `?bool` | yes |

```php
$result = $enhance->websites->setWebsiteBackupsDisabledStatus('website-id', true);
```

## setWebsiteCgroupLimits

Set the active cgroup limits for a website (Master org only)

`PUT /orgs/{org_id}/websites/{website_id}/cgroup_limits`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$setCgroupLimits` | `SetCgroupLimits` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\SetCgroupLimits;

$setCgroupLimits = new SetCgroupLimits();
$setCgroupLimits->nproc = 1.0;
$setCgroupLimits->memoryLimit = 1.0;
$setCgroupLimits->iops = 1.0;
// ... set further properties as needed

$result = $enhance->websites->setWebsiteCgroupLimits('website-id', $setCgroupLimits);
```

## setWebsiteFsQuotaLimits

Set the active FS quota limits for a website (Master org only)

`PUT /orgs/{org_id}/websites/{website_id}/fs_quota_limits`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$fsQuotaLimit` | `FsQuotaLimit` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\FsQuotaLimit;

$fsQuotaLimit = new FsQuotaLimit();
$fsQuotaLimit->totalAvailable = 1.0;
$fsQuotaLimit->inodesAvailable = 1.0;

$result = $enhance->websites->setWebsiteFsQuotaLimits('website-id', $fsQuotaLimit);
```

## setWebsiteIoncubeStatus

Set ioncube status for an existing website

`PUT /v2/websites/{website_id}/ioncube`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `?bool` | no |

```php
$result = $enhance->websites->setWebsiteIoncubeStatus('website-id');
```

## setWebsiteLsphpSettings

Set the LSPHP settings for this website

`PUT /websites/{website_id}/lsphp_settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$lsphpSettings` | `LsphpSettings` | yes |

```php
use GoSuccess\Enhance\DTO\LsphpSettings;

$lsphpSettings = new LsphpSettings();
$lsphpSettings->lsapiChildren = 1.0;

$result = $enhance->websites->setWebsiteLsphpSettings('website-id', $lsphpSettings);
```

## setWebsiteRedisState

Set Redis state for an existing website

`PUT /v2/websites/{website_id}/redis`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$value` | `?bool` | no |

```php
$result = $enhance->websites->setWebsiteRedisState('website-id');
```

## setWebsiteSetting

Set a single override setting

`PUT /orgs/{org_id}/websites/{website_id}/settings/{setting_kind}/{setting_key}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$settingKind` | `SettingKind` | yes |
| `$settingKey` | `string` | yes |
| `$body` | `mixed` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\Enum\SettingKind;

$result = $enhance->websites->setWebsiteSetting('website-id', SettingKind::PhpIni, 'example', null);
```

## takeScreenshot

Take website screenshot immediately

`POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/screenshot/take`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->takeScreenshot('website-id', 'example.com');
```

## unauthorizeWebsiteSshKey

Unauthorize the public SSH key with the given ID.

`DELETE /orgs/{org_id}/websites/{website_id}/ssh/keys/{key_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$keyId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->websites->unauthorizeWebsiteSshKey('website-id', 'key-id');
```

## updateUserCrontab

Update user's crontab

`PATCH /orgs/{org_id}/websites/{website_id}/crontab`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$updateCrontabFullListing` | `UpdateCrontabFullListing` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateCrontabFullListing;

$updateCrontabFullListing = new UpdateCrontabFullListing();

$result = $enhance->websites->updateUserCrontab('website-id', $updateCrontabFullListing);
```

## updateWebsite

Update website

`PATCH /orgs/{org_id}/websites/{website_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$updateWebsite` | `UpdateWebsite` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateWebsite;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\WebsiteStatus;

$updateWebsite = new UpdateWebsite();
$updateWebsite->phpVersion = PhpVersion::Php56;
$updateWebsite->status = WebsiteStatus::Active;
$updateWebsite->isSuspended = true;
// ... set further properties as needed

$result = $enhance->websites->updateWebsite('website-id', $updateWebsite);
```

## updateWebsiteDomainMapping

Update website domain mapping

`PATCH /orgs/{org_id}/websites/{website_id}/domains/{domain_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$domainMappingUpdate` | `DomainMappingUpdate` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\DomainMappingUpdate;
use GoSuccess\Enhance\Enum\DomainMappingKind;

$domainMappingUpdate = new DomainMappingUpdate();
$domainMappingUpdate->documentRoot = 'example';
$domainMappingUpdate->kind = DomainMappingKind::Primary;

$result = $enhance->websites->updateWebsiteDomainMapping('website-id', 'example.com', $domainMappingUpdate);
```

## updateWebsiteHtaccessIpsRule

Sets a rule over provided ips - either block or allow

`PUT /orgs/{org_id}/websites/{website_id}/htaccess/ips`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$requireIpsRule` | `RequireIpsRule` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\RequireIpsRule;
use GoSuccess\Enhance\Enum\RequireIpsRuleKind;

$requireIpsRule = new RequireIpsRule();
$requireIpsRule->kind = RequireIpsRuleKind::Allow;

$result = $enhance->websites->updateWebsiteHtaccessIpsRule('website-id', $requireIpsRule);
```

## updateWebsiteHtaccessRewrites

Updates rewrite rules

`PATCH /orgs/{org_id}/websites/{website_id}/htaccess`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$updateRewriteChainFullListing` | `UpdateRewriteChainFullListing` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateRewriteChainFullListing;

$updateRewriteChainFullListing = new UpdateRewriteChainFullListing();

$result = $enhance->websites->updateWebsiteHtaccessRewrites('website-id', $updateRewriteChainFullListing);
```

## updateWebsitePrimaryDomain

Update primary domain mapping

`PUT /orgs/{org_id}/websites/{website_id}/domains/primary`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newPrimaryDomainMapping` | `NewPrimaryDomainMapping` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewPrimaryDomainMapping;

$newPrimaryDomainMapping = new NewPrimaryDomainMapping();
$newPrimaryDomainMapping->domainId = 'example.com';

$result = $enhance->websites->updateWebsitePrimaryDomain('website-id', $newPrimaryDomainMapping);
```

## updateWebsiteSshKey

Update an existing website public SSH key.

`PATCH /orgs/{org_id}/websites/{website_id}/ssh/keys/{key_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$keyId` | `string` | yes |
| `$sshKeyUpdate` | `SshKeyUpdate` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\SshKeyUpdate;

$sshKeyUpdate = new SshKeyUpdate();
$sshKeyUpdate->value = 'example';
$sshKeyUpdate->name = 'example';

$result = $enhance->websites->updateWebsiteSshKey('website-id', 'key-id', $sshKeyUpdate);
```

## validateWebsiteOperation

Validate whether a website operation is allowed

`POST /orgs/{org_id}/websites/{website_id}/validate-operation`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$websiteOperationValidation` | `WebsiteOperationValidation` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\WebsiteOperationValidation;
use GoSuccess\Enhance\Enum\WebsiteOperation;

$websiteOperationValidation = new WebsiteOperationValidation();
$websiteOperationValidation->operation = WebsiteOperation::ChangeSubscription;

$result = $enhance->websites->validateWebsiteOperation('website-id', $websiteOperationValidation);
```

