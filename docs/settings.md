# SettingsResource

Accessed via `$enhance->settings`.

| Method | Route |
| ------ | ----- |
| [`addOrchdLoginPolicyEmailBlacklist`](#addorchdloginpolicyemailblacklist) | `PUT /settings/orchd/login-policy/email-blacklist` |
| [`addOrchdLoginPolicyEmailWhitelist`](#addorchdloginpolicyemailwhitelist) | `PUT /settings/orchd/login-policy/email-whitelist` |
| [`addOrchdLoginPolicyIpBlacklist`](#addorchdloginpolicyipblacklist) | `PUT /settings/orchd/login-policy/ip-blacklist` |
| [`addOrchdLoginPolicyIpWhitelist`](#addorchdloginpolicyipwhitelist) | `PUT /settings/orchd/login-policy/ip-whitelist` |
| [`addOrchdLoginPolicySettings`](#addorchdloginpolicysettings) | `PUT /settings/orchd/login-policy/settings` |
| [`createBackupRemoteStorageS3`](#createbackupremotestorages3) | `POST /v2/settings/backup/remote_storage/s3` |
| [`createSettings`](#createsettings) | `POST /settings` |
| [`deleteBackupRemoteStorageS3`](#deletebackupremotestorages3) | `DELETE /v2/settings/backup/remote_storage/s3` |
| [`deleteGlobalServiceSetting`](#deleteglobalservicesetting) | `DELETE /settings/service/{setting_kind}/{setting_key}` |
| [`deleteOrchdLoginPolicyEmailBlacklist`](#deleteorchdloginpolicyemailblacklist) | `DELETE /settings/orchd/login-policy/email-blacklist` |
| [`deleteOrchdLoginPolicyEmailWhitelist`](#deleteorchdloginpolicyemailwhitelist) | `DELETE /settings/orchd/login-policy/email-whitelist` |
| [`deleteOrchdLoginPolicyIpBlacklist`](#deleteorchdloginpolicyipblacklist) | `DELETE /settings/orchd/login-policy/ip-blacklist` |
| [`deleteOrchdLoginPolicyIpWhitelist`](#deleteorchdloginpolicyipwhitelist) | `DELETE /settings/orchd/login-policy/ip-whitelist` |
| [`deleteSetting`](#deletesetting) | `DELETE /settings/{name}` |
| [`getAdminLockdownList`](#getadminlockdownlist) | `GET /settings/orchd/admin-lockdown/list` |
| [`getAdminLockdownStatus`](#getadminlockdownstatus) | `GET /settings/orchd/admin-lockdown/status` |
| [`getBackupRemoteStorageS3`](#getbackupremotestorages3) | `GET /v2/settings/backup/remote_storage/s3` |
| [`getDemoMode`](#getdemomode) | `GET /v2/settings/demo_mode` |
| [`getGlobalServiceSetting`](#getglobalservicesetting) | `GET /settings/service/{setting_kind}` |
| [`getOrchdLogSettings`](#getorchdlogsettings) | `GET /settings/orchd/logs` |
| [`getOrchdLoginPolicyEmailBlacklist`](#getorchdloginpolicyemailblacklist) | `GET /settings/orchd/login-policy/email-blacklist` |
| [`getOrchdLoginPolicyEmailWhitelist`](#getorchdloginpolicyemailwhitelist) | `GET /settings/orchd/login-policy/email-whitelist` |
| [`getOrchdLoginPolicyIpBlacklist`](#getorchdloginpolicyipblacklist) | `GET /settings/orchd/login-policy/ip-blacklist` |
| [`getOrchdLoginPolicyIpWhitelist`](#getorchdloginpolicyipwhitelist) | `GET /settings/orchd/login-policy/ip-whitelist` |
| [`getOrchdLoginPolicySettings`](#getorchdloginpolicysettings) | `GET /settings/orchd/login-policy/settings` |
| [`getProhibitedDomains`](#getprohibiteddomains) | `GET /settings/orchd/prohibited_domains` |
| [`getSetting`](#getsetting) | `GET /settings/{name}` |
| [`getSettings`](#getsettings) | `GET /settings` |
| [`setAdminLockdownList`](#setadminlockdownlist) | `PUT /settings/orchd/admin-lockdown/list` |
| [`setAdminLockdownStatus`](#setadminlockdownstatus) | `PUT /settings/orchd/admin-lockdown/status` |
| [`setGlobalServiceSetting`](#setglobalservicesetting) | `PUT /settings/service/{setting_kind}/{setting_key}` |
| [`setOrchdLogSettings`](#setorchdlogsettings) | `PUT /settings/orchd/logs` |
| [`setProhibitedDomains`](#setprohibiteddomains) | `PUT /settings/orchd/prohibited_domains` |
| [`updateBackupRemoteStorageS3`](#updatebackupremotestorages3) | `PATCH /v2/settings/backup/remote_storage/s3` |
| [`updateSetting`](#updatesetting) | `PUT /settings/{name}` |

## addOrchdLoginPolicyEmailBlacklist

Set the orchd login policy email blacklist as a whole

`PUT /settings/orchd/login-policy/email-blacklist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLoginPolicyEmailList` | `OrchdLoginPolicyEmailList` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLoginPolicyEmailList;

$orchdLoginPolicyEmailList = new OrchdLoginPolicyEmailList();

$result = $enhance->settings->addOrchdLoginPolicyEmailBlacklist($orchdLoginPolicyEmailList);
```

## addOrchdLoginPolicyEmailWhitelist

Set the orchd login policy email whitelist as a whole

`PUT /settings/orchd/login-policy/email-whitelist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLoginPolicyEmailList` | `OrchdLoginPolicyEmailList` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLoginPolicyEmailList;

$orchdLoginPolicyEmailList = new OrchdLoginPolicyEmailList();

$result = $enhance->settings->addOrchdLoginPolicyEmailWhitelist($orchdLoginPolicyEmailList);
```

## addOrchdLoginPolicyIpBlacklist

Set the orchd login policy ip blacklist as a whole

`PUT /settings/orchd/login-policy/ip-blacklist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLoginPolicyIpList` | `OrchdLoginPolicyIpList` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLoginPolicyIpList;

$orchdLoginPolicyIpList = new OrchdLoginPolicyIpList();

$result = $enhance->settings->addOrchdLoginPolicyIpBlacklist($orchdLoginPolicyIpList);
```

## addOrchdLoginPolicyIpWhitelist

Set the orchd login policy ip whitelist as a whole

`PUT /settings/orchd/login-policy/ip-whitelist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLoginPolicyIpList` | `OrchdLoginPolicyIpList` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLoginPolicyIpList;

$orchdLoginPolicyIpList = new OrchdLoginPolicyIpList();

$result = $enhance->settings->addOrchdLoginPolicyIpWhitelist($orchdLoginPolicyIpList);
```

## addOrchdLoginPolicySettings

Set a single orchd login policy setting

`PUT /settings/orchd/login-policy/settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLoginPolicySettings` | `OrchdLoginPolicySettings` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLoginPolicySettings;

$orchdLoginPolicySettings = new OrchdLoginPolicySettings();
$orchdLoginPolicySettings->enabled = true;
$orchdLoginPolicySettings->emailQuota = 10;
$orchdLoginPolicySettings->emailAutoBlockEnabled = true;
// ... set further properties as needed

$result = $enhance->settings->addOrchdLoginPolicySettings($orchdLoginPolicySettings);
```

## createBackupRemoteStorageS3

Create S3 object storage settings at platform level.

`POST /v2/settings/backup/remote_storage/s3`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$createBackupRemoteStorageS3` | `CreateBackupRemoteStorageS3` | yes |

```php
use GoSuccess\Enhance\DTO\CreateBackupRemoteStorageS3;
use GoSuccess\Enhance\Enum\RemoteStoragePurpose;

$createBackupRemoteStorageS3 = new CreateBackupRemoteStorageS3();
$createBackupRemoteStorageS3->purpose = RemoteStoragePurpose::Backup;
$createBackupRemoteStorageS3->region = 'example';
$createBackupRemoteStorageS3->endpoint = 'example';
// ... set further properties as needed

$result = $enhance->settings->createBackupRemoteStorageS3($createBackupRemoteStorageS3);
```

## createSettings

Create settings

`POST /settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$items` | `?array` | yes |

```php
$result = $enhance->settings->createSettings([]);
```

## deleteBackupRemoteStorageS3

Delete S3 object storage settings at platform level.

`DELETE /v2/settings/backup/remote_storage/s3`

```php
$result = $enhance->settings->deleteBackupRemoteStorageS3();
```

## deleteGlobalServiceSetting

Delete a single global service setting

`DELETE /settings/service/{setting_kind}/{setting_key}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$settingKind` | `SettingKind` | yes |
| `$settingKey` | `string` | yes |

```php
use GoSuccess\Enhance\Enum\SettingKind;

$result = $enhance->settings->deleteGlobalServiceSetting(SettingKind::PhpIni, 'example');
```

## deleteOrchdLoginPolicyEmailBlacklist

Delete an orchd login policy email blacklist

`DELETE /settings/orchd/login-policy/email-blacklist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLoginPolicyEmailList` | `OrchdLoginPolicyEmailList` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLoginPolicyEmailList;

$orchdLoginPolicyEmailList = new OrchdLoginPolicyEmailList();

$result = $enhance->settings->deleteOrchdLoginPolicyEmailBlacklist($orchdLoginPolicyEmailList);
```

## deleteOrchdLoginPolicyEmailWhitelist

Delete an orchd login policy email whitelist

`DELETE /settings/orchd/login-policy/email-whitelist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLoginPolicyEmailList` | `OrchdLoginPolicyEmailList` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLoginPolicyEmailList;

$orchdLoginPolicyEmailList = new OrchdLoginPolicyEmailList();

$result = $enhance->settings->deleteOrchdLoginPolicyEmailWhitelist($orchdLoginPolicyEmailList);
```

## deleteOrchdLoginPolicyIpBlacklist

Delete an orchd login policy ip blacklist

`DELETE /settings/orchd/login-policy/ip-blacklist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLoginPolicyIpList` | `OrchdLoginPolicyIpList` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLoginPolicyIpList;

$orchdLoginPolicyIpList = new OrchdLoginPolicyIpList();

$result = $enhance->settings->deleteOrchdLoginPolicyIpBlacklist($orchdLoginPolicyIpList);
```

## deleteOrchdLoginPolicyIpWhitelist

Delete an orchd login policy ip whitelist

`DELETE /settings/orchd/login-policy/ip-whitelist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLoginPolicyIpList` | `OrchdLoginPolicyIpList` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLoginPolicyIpList;

$orchdLoginPolicyIpList = new OrchdLoginPolicyIpList();

$result = $enhance->settings->deleteOrchdLoginPolicyIpWhitelist($orchdLoginPolicyIpList);
```

## deleteSetting

Remove the specified setting

`DELETE /settings/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$name` | `string` | yes |

```php
$result = $enhance->settings->deleteSetting('example');
```

## getAdminLockdownList

Get the list of allowed IPs for master organisation login, line separated

`GET /settings/orchd/admin-lockdown/list`

```php
$result = $enhance->settings->getAdminLockdownList();
```

## getAdminLockdownStatus

Check if master organisation IP lockdown is enabled

`GET /settings/orchd/admin-lockdown/status`

```php
$result = $enhance->settings->getAdminLockdownStatus();
```

## getBackupRemoteStorageS3

Get S3 object storage settings at platform level.

`GET /v2/settings/backup/remote_storage/s3`

```php
$result = $enhance->settings->getBackupRemoteStorageS3();
```

## getDemoMode

Get the demo mode status of the orchd service

`GET /v2/settings/demo_mode`

```php
$result = $enhance->settings->getDemoMode();
```

## getGlobalServiceSetting

Get the value for a particular global service setting

`GET /settings/service/{setting_kind}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$settingKind` | `SettingKind` | yes |

```php
use GoSuccess\Enhance\Enum\SettingKind;

$result = $enhance->settings->getGlobalServiceSetting(SettingKind::PhpIni);
```

## getOrchdLogSettings

Get the orchd log settings

`GET /settings/orchd/logs`

```php
$result = $enhance->settings->getOrchdLogSettings();
```

## getOrchdLoginPolicyEmailBlacklist

Get the orchd login policy email blacklist

`GET /settings/orchd/login-policy/email-blacklist`

```php
$result = $enhance->settings->getOrchdLoginPolicyEmailBlacklist();
```

## getOrchdLoginPolicyEmailWhitelist

Get the orchd login policy email whitelist

`GET /settings/orchd/login-policy/email-whitelist`

```php
$result = $enhance->settings->getOrchdLoginPolicyEmailWhitelist();
```

## getOrchdLoginPolicyIpBlacklist

Get the orchd login policy ip blacklist

`GET /settings/orchd/login-policy/ip-blacklist`

```php
$result = $enhance->settings->getOrchdLoginPolicyIpBlacklist();
```

## getOrchdLoginPolicyIpWhitelist

Get the orchd login policy ip whitelist

`GET /settings/orchd/login-policy/ip-whitelist`

```php
$result = $enhance->settings->getOrchdLoginPolicyIpWhitelist();
```

## getOrchdLoginPolicySettings

Get the orchd login policy settings

`GET /settings/orchd/login-policy/settings`

```php
$result = $enhance->settings->getOrchdLoginPolicySettings();
```

## getProhibitedDomains

Get the platform level prohibited domains as a newline separated list

`GET /settings/orchd/prohibited_domains`

```php
$result = $enhance->settings->getProhibitedDomains();
```

## getSetting

Get the specified setting

`GET /settings/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$name` | `string` | yes |

```php
$result = $enhance->settings->getSetting('example');
```

## getSettings

Get all current settings

`GET /settings`

```php
$result = $enhance->settings->getSettings();
```

## setAdminLockdownList

Set admin lockdown list as a whole

`PUT /settings/orchd/admin-lockdown/list`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$value` | `?string` | yes |

```php
$result = $enhance->settings->setAdminLockdownList('example');
```

## setAdminLockdownStatus

Set admin lockdown status

`PUT /settings/orchd/admin-lockdown/status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$value` | `?bool` | yes |

```php
$result = $enhance->settings->setAdminLockdownStatus(true);
```

## setGlobalServiceSetting

Set a single global service setting

`PUT /settings/service/{setting_kind}/{setting_key}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$settingKind` | `SettingKind` | yes |
| `$settingKey` | `string` | yes |
| `$body` | `mixed` | yes |

```php
use GoSuccess\Enhance\Enum\SettingKind;

$result = $enhance->settings->setGlobalServiceSetting(SettingKind::PhpIni, 'example', null);
```

## setOrchdLogSettings

Set the orchd log settings

`PUT /settings/orchd/logs`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orchdLogSettings` | `OrchdLogSettings` | yes |

```php
use GoSuccess\Enhance\DTO\OrchdLogSettings;
use GoSuccess\Enhance\Enum\LogLevelLimit;

$orchdLogSettings = new OrchdLogSettings();
$orchdLogSettings->limit = LogLevelLimit::Error;

$result = $enhance->settings->setOrchdLogSettings($orchdLogSettings);
```

## setProhibitedDomains

Set the platform level prohibited domains

`PUT /settings/orchd/prohibited_domains`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$value` | `?string` | yes |

```php
$result = $enhance->settings->setProhibitedDomains('example');
```

## updateBackupRemoteStorageS3

Update S3 object storage settings at platform level.

`PATCH /v2/settings/backup/remote_storage/s3`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$updateBackupRemoteStorageS3` | `UpdateBackupRemoteStorageS3` | yes |

```php
use GoSuccess\Enhance\DTO\UpdateBackupRemoteStorageS3;

$updateBackupRemoteStorageS3 = new UpdateBackupRemoteStorageS3();
$updateBackupRemoteStorageS3->region = 'example';
$updateBackupRemoteStorageS3->endpoint = 'example';
$updateBackupRemoteStorageS3->bucket = 'example';
// ... set further properties as needed

$result = $enhance->settings->updateBackupRemoteStorageS3($updateBackupRemoteStorageS3);
```

## updateSetting

Create or update the specified setting

`PUT /settings/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$name` | `string` | yes |
| `$body` | `mixed` | yes |

```php
$result = $enhance->settings->updateSetting('example', null);
```

