# ServersResource

Accessed via `$enhance->servers`.

| Method | Route |
| ------ | ----- |
| [`addSpamIpWhitelist`](#addspamipwhitelist) | `POST /servers/{server_id}/spam/ip_whitelist` |
| [`configureServer`](#configureserver) | `PATCH /servers/{server_id}` |
| [`createServerDomain`](#createserverdomain) | `POST /servers/{server_id}/domains` |
| [`createServerGroup`](#createservergroup) | `POST /servers/groups` |
| [`createServerNetworkInterfaceIp`](#createservernetworkinterfaceip) | `POST /servers/{server_id}/interfaces/{interface}/ips` |
| [`createSlave`](#createslave) | `POST /servers/slaves` |
| [`deleteFromSpamIpWhitelist`](#deletefromspamipwhitelist) | `DELETE /servers/{server_id}/spam/ip_whitelist` |
| [`deleteServerDomain`](#deleteserverdomain) | `DELETE /servers/{server_id}/domains/{domain_id}` |
| [`deleteServerFromGroup`](#deleteserverfromgroup) | `DELETE /servers/{server_id}/group` |
| [`deleteServerGroup`](#deleteservergroup) | `DELETE /servers/groups/{group_id}` |
| [`deleteServerNetworkInterfaceIp`](#deleteservernetworkinterfaceip) | `DELETE /servers/{server_id}/interfaces/{interface}/ips/{ip}` |
| [`deleteServerPrimaryIpv6`](#deleteserverprimaryipv6) | `DELETE /v2/servers/{server_id}/primary-ipv6` |
| [`deleteServiceSetting`](#deleteservicesetting) | `DELETE /servers/{server_id}/settings/{setting_kind}/{setting_key}` |
| [`deleteSlave`](#deleteslave) | `DELETE /servers/{server_id}` |
| [`enableFsQuotaLimits`](#enablefsquotalimits) | `POST /servers/{server_id}/fs-quota-limits` |
| [`getAppcdScreenshotConfig`](#getappcdscreenshotconfig) | `GET /servers/{server_id}/appcd/screenshot/config` |
| [`getAppcdVersion`](#getappcdversion) | `GET /servers/{server_id}/appcd/version` |
| [`getClientIp`](#getclientip) | `GET /client_ip` |
| [`getDatabaseRoleMysqlKind`](#getdatabaserolemysqlkind) | `GET /v2/servers/{server_id}/database-role` |
| [`getDnsPoolIps`](#getdnspoolips) | `GET /v2/servers/dns_pool` |
| [`getEmailServerHostnameOverride`](#getemailserverhostnameoverride) | `GET /servers/{server_id}/email/hostname_override` |
| [`getFsQuotaStatus`](#getfsquotastatus) | `GET /servers/{server_id}/fs-quota-limits` |
| [`getHttpdStatus`](#gethttpdstatus) | `GET /servers/{server_id}/roles/{role}/httpd_status` |
| [`getInstallCmd`](#getinstallcmd) | `GET /servers/install-cmd` |
| [`getMysqlMyCnf`](#getmysqlmycnf) | `GET /v2/servers/{server_id}/my-cnf` |
| [`getOutboundSpamScanningSettings`](#getoutboundspamscanningsettings) | `GET /servers/{server_id}/email/spam/outbound_scanning` |
| [`getOwaspRulesVersion`](#getowasprulesversion) | `GET /v2/servers/{server_id}/owasp` |
| [`getRegistrationKey`](#getregistrationkey) | `GET /servers/registration-key` |
| [`getRoundcubeSsoEnabled`](#getroundcubessoenabled) | `GET /servers/{server_id}/roundcube_sso_enabled` |
| [`getServerDiskUsage`](#getserverdiskusage) | `GET /servers/{server_id}/disk-usage` |
| [`getServerFpmSettings`](#getserverfpmsettings) | `GET /servers/{server_id}/php/fpm` |
| [`getServerGroups`](#getservergroups) | `GET /servers/groups` |
| [`getServerHostnameWebsite`](#getserverhostnamewebsite) | `GET /servers/{server_id}/domains` |
| [`getServerInfo`](#getserverinfo) | `GET /servers/{server_id}` |
| [`getServerIowait`](#getserveriowait) | `GET /servers/{server_id}/iowait` |
| [`getServerLoad`](#getserverload) | `GET /servers/{server_id}/load` |
| [`getServerMemoryUsage`](#getservermemoryusage) | `GET /servers/{server_id}/memory-usage` |
| [`getServerModSecurityConfig`](#getservermodsecurityconfig) | `GET /v2/servers/{server_id}/modsec_conf` |
| [`getServerModSecurityStatus`](#getservermodsecuritystatus) | `GET /v2/servers/{server_id}/modsec_status` |
| [`getServerNetworkInterfaces`](#getservernetworkinterfaces) | `GET /servers/{server_id}/interfaces` |
| [`getServerNetworkStats`](#getservernetworkstats) | `GET /servers/{server_id}/network-stats` |
| [`getServerRole`](#getserverrole) | `GET /servers/{server_id}/roles/{role}` |
| [`getServerRoles`](#getserverroles) | `GET /servers/{server_id}/roles` |
| [`getServerSpecs`](#getserverspecs) | `GET /servers/{server_id}/specs` |
| [`getServerStats`](#getserverstats) | `GET /servers/{server_id}/historic-stats` |
| [`getServerStatus`](#getserverstatus) | `GET /servers/{server_id}/status` |
| [`getServerUptime`](#getserveruptime) | `GET /servers/{server_id}/uptime` |
| [`getServers`](#getservers) | `GET /servers` |
| [`getServiceSetting`](#getservicesetting) | `GET /servers/{server_id}/settings/{setting_kind}` |
| [`getSmtpRateLimitHourly`](#getsmtpratelimithourly) | `GET /servers/{server_id}/spam/smtp_rate_limit_hourly` |
| [`getSpamIpWhitelist`](#getspamipwhitelist) | `GET /servers/{server_id}/spam/ip_whitelist` |
| [`getSystemPackageUpdateInfo`](#getsystempackageupdateinfo) | `GET /servers/{server_id}/packages/update` |
| [`getWebserverKind`](#getwebserverkind) | `GET /servers/{server_id}/webserver` |
| [`getWebsiteFpmSettings`](#getwebsitefpmsettings) | `GET /servers/{server_id}/php/fpm/{website_id}` |
| [`getWebsiteGeneratedRateLimitHourly`](#getwebsitegeneratedratelimithourly) | `GET /servers/{server_id}/spam/website_generated_rate_limit_hourly` |
| [`installDatabaseRole`](#installdatabaserole) | `PUT /v2/servers/{server_id}/database-role` |
| [`installServerRole`](#installserverrole) | `PUT /servers/{server_id}/roles/{role}` |
| [`resetServerModSecurityConfig`](#resetservermodsecurityconfig) | `DELETE /v2/servers/{server_id}/modsec_conf` |
| [`resetWebServerConfig`](#resetwebserverconfig) | `POST /servers/{server_id}/webserver/config/reset` |
| [`restartMysql`](#restartmysql) | `POST /v2/servers/{server_id}/database-role/restart` |
| [`saveMysqlMyCnf`](#savemysqlmycnf) | `PUT /v2/servers/{server_id}/my-cnf` |
| [`setEmailServerHostnameOverride`](#setemailserverhostnameoverride) | `PUT /servers/{server_id}/email/hostname_override` |
| [`setLiteSpeedAdminPassword`](#setlitespeedadminpassword) | `POST /servers/{server_id}/webserver/litespeed/password` |
| [`setOutboundSpamScanningSettings`](#setoutboundspamscanningsettings) | `PUT /servers/{server_id}/email/spam/outbound_scanning` |
| [`setRoundcubeSsoEnabled`](#setroundcubessoenabled) | `PUT /servers/{server_id}/roundcube_sso_enabled` |
| [`setServerDecommissioned`](#setserverdecommissioned) | `PUT /servers/{server_id}/decommissioned` |
| [`setServerModSecurityConfig`](#setservermodsecurityconfig) | `PUT /v2/servers/{server_id}/modsec_conf` |
| [`setServerModSecurityStatus`](#setservermodsecuritystatus) | `PUT /v2/servers/{server_id}/modsec_status` |
| [`setServerStatus`](#setserverstatus) | `POST /servers/{server_id}/status` |
| [`setServiceSetting`](#setservicesetting) | `PUT /servers/{server_id}/settings/{setting_kind}/{setting_key}` |
| [`setSmtpRateLimitHourly`](#setsmtpratelimithourly) | `PUT /servers/{server_id}/spam/smtp_rate_limit_hourly` |
| [`setWebserverKind`](#setwebserverkind) | `PUT /servers/{server_id}/webserver` |
| [`setWebsiteGeneratedRateLimitHourly`](#setwebsitegeneratedratelimithourly) | `PUT /servers/{server_id}/spam/website_generated_rate_limit_hourly` |
| [`uninstallServerRole`](#uninstallserverrole) | `DELETE /servers/{server_id}/roles/{role}` |
| [`updateAppcdScreenshotConfig`](#updateappcdscreenshotconfig) | `PATCH /servers/{server_id}/appcd/screenshot/config` |
| [`updateOwaspRules`](#updateowasprules) | `POST /v2/servers/{server_id}/owasp` |
| [`updateServerGroup`](#updateservergroup) | `PUT /servers/groups/{group_id}` |
| [`updateServerPrimaryIp`](#updateserverprimaryip) | `PUT /servers/{server_id}/primary-ip` |
| [`updateServerPrimaryIpv6`](#updateserverprimaryipv6) | `PUT /v2/servers/{server_id}/primary-ipv6` |
| [`updateServerRole`](#updateserverrole) | `PATCH /servers/{server_id}/roles/{role}` |
| [`updateSystemPackage`](#updatesystempackage) | `PUT /servers/{server_id}/packages/update` |
| [`validateRegistrationKey`](#validateregistrationkey) | `POST /servers/registration-key/validate` |

## addSpamIpWhitelist

Add to the IP whitelist

`POST /servers/{server_id}/spam/ip_whitelist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?string` | no |

```php
$result = $enhance->servers->addSpamIpWhitelist('server-id');
```

## configureServer

Configure a server

`PATCH /servers/{server_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$serverConf` | `ServerConf` | yes |

```php
use GoSuccess\Enhance\DTO\ServerConf;

$serverConf = new ServerConf();
$serverConf->friendlyName = 'example';
$serverConf->group = 'example';

$result = $enhance->servers->configureServer('server-id', $serverConf);
```

## createServerDomain

Create a domain which is mapped to a server

`POST /servers/{server_id}/domains`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->servers->createServerDomain('server-id', 'example');
```

## createServerGroup

Creates a new server group

`POST /servers/groups`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newServerGroup` | `NewServerGroup` | yes |

```php
use GoSuccess\Enhance\DTO\NewServerGroup;

$newServerGroup = new NewServerGroup();
$newServerGroup->name = 'example';

$result = $enhance->servers->createServerGroup($newServerGroup);
```

## createServerNetworkInterfaceIp

Create server network interface secondary IP

`POST /servers/{server_id}/interfaces/{interface}/ips`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$interface` | `string` | yes |
| `$newServerIp` | `NewServerIp` | yes |

```php
use GoSuccess\Enhance\DTO\NewServerIp;

$newServerIp = new NewServerIp();
$newServerIp->ip = 'example';
$newServerIp->prefix = 'example';

$result = $enhance->servers->createServerNetworkInterfaceIp('server-id', 'example', $newServerIp);
```

## createSlave

Create a slave node

`POST /servers/slaves`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$slaveRegistration` | `SlaveRegistration` | yes |
| `$key` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\SlaveRegistration;

$slaveRegistration = new SlaveRegistration();
$slaveRegistration->hostname = 'example';

$result = $enhance->servers->createSlave($slaveRegistration);
```

## deleteFromSpamIpWhitelist

Delete from the IP whitelist

`DELETE /servers/{server_id}/spam/ip_whitelist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?string` | no |

```php
$result = $enhance->servers->deleteFromSpamIpWhitelist('server-id');
```

## deleteServerDomain

Delete a mapped server domain

`DELETE /servers/{server_id}/domains/{domain_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$domainId` | `string` | yes |

```php
$result = $enhance->servers->deleteServerDomain('server-id', 'example.com');
```

## deleteServerFromGroup

Delete server from group

`DELETE /servers/{server_id}/group`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->deleteServerFromGroup('server-id');
```

## deleteServerGroup

Deletes an existing server group

`DELETE /servers/groups/{group_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$groupId` | `string` | yes |

```php
$result = $enhance->servers->deleteServerGroup('group-id');
```

## deleteServerNetworkInterfaceIp

Delete server network interface secondary IP

`DELETE /servers/{server_id}/interfaces/{interface}/ips/{ip}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$interface` | `string` | yes |
| `$ip` | `string` | yes |

```php
$result = $enhance->servers->deleteServerNetworkInterfaceIp('server-id', 'example', 'example');
```

## deleteServerPrimaryIpv6

Deletes/unsets the primary IPv6 address for a server.

`DELETE /v2/servers/{server_id}/primary-ipv6`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->deleteServerPrimaryIpv6('server-id');
```

## deleteServiceSetting

Delete a single override setting

`DELETE /servers/{server_id}/settings/{setting_kind}/{setting_key}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$settingKind` | `SettingKind` | yes |
| `$settingKey` | `string` | yes |

```php
use GoSuccess\Enhance\Enum\SettingKind;

$result = $enhance->servers->deleteServiceSetting('server-id', SettingKind::PhpIni, 'example');
```

## deleteSlave

Delete a (slave) server

`DELETE /servers/{server_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->deleteSlave('server-id');
```

## enableFsQuotaLimits

Enable FS quota limits on the server

`POST /servers/{server_id}/fs-quota-limits`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->enableFsQuotaLimits('server-id');
```

## getAppcdScreenshotConfig

Get the screenshot config of the running appcd

`GET /servers/{server_id}/appcd/screenshot/config`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getAppcdScreenshotConfig('server-id');
```

## getAppcdVersion

Get the version of the running appcd

`GET /servers/{server_id}/appcd/version`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getAppcdVersion('server-id');
```

## getClientIp

Reflect back the IP of the API consumer

`GET /client_ip`

```php
$result = $enhance->servers->getClientIp();
```

## getDatabaseRoleMysqlKind

Gets the MySQL kind for a given server.

`GET /v2/servers/{server_id}/database-role`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$mysqlKind` | `?MysqlKind` | no |

```php
$result = $enhance->servers->getDatabaseRoleMysqlKind('server-id');
```

## getDnsPoolIps

Get DNS pool IPs

`GET /v2/servers/dns_pool`

```php
$result = $enhance->servers->getDnsPoolIps();
```

## getEmailServerHostnameOverride

Get the hostname override for the email server (postfix) if set

`GET /servers/{server_id}/email/hostname_override`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getEmailServerHostnameOverride('server-id');
```

## getFsQuotaStatus

Get whether FS quota was enabled on the server

`GET /servers/{server_id}/fs-quota-limits`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getFsQuotaStatus('server-id');
```

## getHttpdStatus

Get status of a running httpd server.

`GET /servers/{server_id}/roles/{role}/httpd_status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$role` | `ServerRole` | yes |

```php
use GoSuccess\Enhance\Enum\ServerRole;

$result = $enhance->servers->getHttpdStatus('server-id', ServerRole::Email);
```

## getInstallCmd

Get slave installation command

`GET /servers/install-cmd`

```php
$result = $enhance->servers->getInstallCmd();
```

## getMysqlMyCnf

Download my.cnf for a given server

`GET /v2/servers/{server_id}/my-cnf`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getMysqlMyCnf('server-id');
```

## getOutboundSpamScanningSettings

Get the status of outbound spam scanning

`GET /servers/{server_id}/email/spam/outbound_scanning`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getOutboundSpamScanningSettings('server-id');
```

## getOwaspRulesVersion

Get the current and available version of the OWASP rules

`GET /v2/servers/{server_id}/owasp`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getOwaspRulesVersion('server-id');
```

## getRegistrationKey

Get slave registration key

`GET /servers/registration-key`

```php
$result = $enhance->servers->getRegistrationKey();
```

## getRoundcubeSsoEnabled

Check if Roundcube SSO is enabled on this server

`GET /servers/{server_id}/roundcube_sso_enabled`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getRoundcubeSsoEnabled('server-id');
```

## getServerDiskUsage

Get server disk usage

`GET /servers/{server_id}/disk-usage`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerDiskUsage('server-id');
```

## getServerFpmSettings

Get php-fpm config for all the websites on a server

`GET /servers/{server_id}/php/fpm`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerFpmSettings('server-id');
```

## getServerGroups

Returns all server groups

`GET /servers/groups`

```php
$result = $enhance->servers->getServerGroups();
```

## getServerHostnameWebsite

Get domains which are mapped to a server

`GET /servers/{server_id}/domains`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerHostnameWebsite('server-id');
```

## getServerInfo

Get server info

`GET /servers/{server_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerInfo('server-id');
```

## getServerIowait

Get server iowait

`GET /servers/{server_id}/iowait`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerIowait('server-id');
```

## getServerLoad

Get server system load

`GET /servers/{server_id}/load`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerLoad('server-id');
```

## getServerMemoryUsage

Get server memory usage

`GET /servers/{server_id}/memory-usage`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerMemoryUsage('server-id');
```

## getServerModSecurityConfig

Get mod security config

`GET /v2/servers/{server_id}/modsec_conf`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerModSecurityConfig('server-id');
```

## getServerModSecurityStatus

Get mod security status for a server

`GET /v2/servers/{server_id}/modsec_status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerModSecurityStatus('server-id');
```

## getServerNetworkInterfaces

Get server network interfaces

`GET /servers/{server_id}/interfaces`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerNetworkInterfaces('server-id');
```

## getServerNetworkStats

Get server network stats

`GET /servers/{server_id}/network-stats`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerNetworkStats('server-id');
```

## getServerRole

Get server role info

`GET /servers/{server_id}/roles/{role}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$role` | `ServerRole` | yes |
| `$disableRoleOnInstallation` | `?bool` | no |

```php
use GoSuccess\Enhance\Enum\ServerRole;

$result = $enhance->servers->getServerRole('server-id', ServerRole::Email);
```

## getServerRoles

Get server roles info

`GET /servers/{server_id}/roles`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerRoles('server-id');
```

## getServerSpecs

Get server specs

`GET /servers/{server_id}/specs`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerSpecs('server-id');
```

## getServerStats

Get Server stats

`GET /servers/{server_id}/historic-stats`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$start` | `?string` | no |
| `$end` | `?string` | no |

```php
$result = $enhance->servers->getServerStats('server-id');
```

## getServerStatus

Get server status

`GET /servers/{server_id}/status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerStatus('server-id');
```

## getServerUptime

Get server uptime in seconds

`GET /servers/{server_id}/uptime`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getServerUptime('server-id');
```

## getServers

Get installed servers

`GET /servers`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortOrder` | `?string` | no |
| `$sortBy` | `?string` | no |

```php
$result = $enhance->servers->getServers();
```

## getServiceSetting

Get the value for a particular setting

`GET /servers/{server_id}/settings/{setting_kind}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$settingKind` | `SettingKind` | yes |

```php
use GoSuccess\Enhance\Enum\SettingKind;

$result = $enhance->servers->getServiceSetting('server-id', SettingKind::PhpIni);
```

## getSmtpRateLimitHourly

Get the hourly SMTP rate limit

`GET /servers/{server_id}/spam/smtp_rate_limit_hourly`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getSmtpRateLimitHourly('server-id');
```

## getSpamIpWhitelist

Get the IP whitelist

`GET /servers/{server_id}/spam/ip_whitelist`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getSpamIpWhitelist('server-id');
```

## getSystemPackageUpdateInfo

Returns a map of upgradable packages.

`GET /servers/{server_id}/packages/update`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$systemPackageName` | `?SystemPackageName` | no |

```php
$result = $enhance->servers->getSystemPackageUpdateInfo('server-id');
```

## getWebserverKind

Get web server

`GET /servers/{server_id}/webserver`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getWebserverKind('server-id');
```

## getWebsiteFpmSettings

Get php-fpm config for the specified website

`GET /servers/{server_id}/php/fpm/{website_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$websiteId` | `string` | yes |

```php
$result = $enhance->servers->getWebsiteFpmSettings('server-id', 'website-id');
```

## getWebsiteGeneratedRateLimitHourly

Get the hourly website generated email rate limit

`GET /servers/{server_id}/spam/website_generated_rate_limit_hourly`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->getWebsiteGeneratedRateLimitHourly('server-id');
```

## installDatabaseRole

Enables the database role on a given ServerUuid

`PUT /v2/servers/{server_id}/database-role`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$mysqlKind` | `?MysqlKind` | no |

```php
$result = $enhance->servers->installDatabaseRole('server-id');
```

## installServerRole

Install server role

`PUT /servers/{server_id}/roles/{role}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$role` | `ServerRole` | yes |
| `$newBackupRole` | `?NewBackupRole` | no |
| `$disableRoleOnInstallation` | `?bool` | no |

```php
use GoSuccess\Enhance\Enum\ServerRole;

$result = $enhance->servers->installServerRole('server-id', ServerRole::Email);
```

## resetServerModSecurityConfig

Delete custom mod_security config and reset to default

`DELETE /v2/servers/{server_id}/modsec_conf`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->resetServerModSecurityConfig('server-id');
```

## resetWebServerConfig

Reset the config for the web server to default.

`POST /servers/{server_id}/webserver/config/reset`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->resetWebServerConfig('server-id');
```

## restartMysql

Restart MySQL gracefully

`POST /v2/servers/{server_id}/database-role/restart`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->restartMysql('server-id');
```

## saveMysqlMyCnf

Save a new my.cnf

`PUT /v2/servers/{server_id}/my-cnf`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->servers->saveMysqlMyCnf('server-id', 'example');
```

## setEmailServerHostnameOverride

Set the hostname override for the email server (postfix)

`PUT /servers/{server_id}/email/hostname_override`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$emailServerHostnameOverride` | `?EmailServerHostnameOverride` | no |

```php
$result = $enhance->servers->setEmailServerHostnameOverride('server-id');
```

## setLiteSpeedAdminPassword

Set a new LiteSpeed admin password.

`POST /servers/{server_id}/webserver/litespeed/password`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->servers->setLiteSpeedAdminPassword('server-id', 'example');
```

## setOutboundSpamScanningSettings

Set the settings for outbound spam scanning

`PUT /servers/{server_id}/email/spam/outbound_scanning`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$outboundSpamScanningSettings` | `?OutboundSpamScanningSettings` | no |

```php
$result = $enhance->servers->setOutboundSpamScanningSettings('server-id');
```

## setRoundcubeSsoEnabled

Set Roundcube SSO enabled state

`PUT /servers/{server_id}/roundcube_sso_enabled`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?bool` | yes |

```php
$result = $enhance->servers->setRoundcubeSsoEnabled('server-id', true);
```

## setServerDecommissioned

Set server to decommissioned

`PUT /servers/{server_id}/decommissioned`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->setServerDecommissioned('server-id');
```

## setServerModSecurityConfig

Set mod security config

`PUT /v2/servers/{server_id}/modsec_conf`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->servers->setServerModSecurityConfig('server-id', 'example');
```

## setServerModSecurityStatus

Set mod security status for a server

`PUT /v2/servers/{server_id}/modsec_status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$modSecStatus` | `ModSecStatus` | yes |

```php
use GoSuccess\Enhance\DTO\ModSecStatus;

$modSecStatus = new ModSecStatus();
$modSecStatus->enabled = true;

$result = $enhance->servers->setServerModSecurityStatus('server-id', $modSecStatus);
```

## setServerStatus

Set the status of one server.

`POST /servers/{server_id}/status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$setServerStatus` | `SetServerStatus` | yes |

```php
use GoSuccess\Enhance\DTO\SetServerStatus;
use GoSuccess\Enhance\Enum\ServerStatusAction;

$setServerStatus = new SetServerStatus();
$setServerStatus->action = ServerStatusAction::GracefulReboot;

$result = $enhance->servers->setServerStatus('server-id', $setServerStatus);
```

## setServiceSetting

Set a single service setting

`PUT /servers/{server_id}/settings/{setting_kind}/{setting_key}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$settingKind` | `SettingKind` | yes |
| `$settingKey` | `string` | yes |
| `$body` | `mixed` | yes |

```php
use GoSuccess\Enhance\Enum\SettingKind;

$result = $enhance->servers->setServiceSetting('server-id', SettingKind::PhpIni, 'example', null);
```

## setSmtpRateLimitHourly

Set the hourly SMTP rate limit

`PUT /servers/{server_id}/spam/smtp_rate_limit_hourly`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?float` | no |

```php
$result = $enhance->servers->setSmtpRateLimitHourly('server-id');
```

## setWebserverKind

Set the web server kind for one server.

`PUT /servers/{server_id}/webserver`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$setWebserverKind` | `SetWebserverKind` | yes |

```php
use GoSuccess\Enhance\DTO\SetWebserverKind;
use GoSuccess\Enhance\Enum\WebserverKind;

$setWebserverKind = new SetWebserverKind();
$setWebserverKind->webserverKind = WebserverKind::LiteSpeed;
$setWebserverKind->serial = 'example';

$result = $enhance->servers->setWebserverKind('server-id', $setWebserverKind);
```

## setWebsiteGeneratedRateLimitHourly

Set the hourly SMTP rate limit

`PUT /servers/{server_id}/spam/website_generated_rate_limit_hourly`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?float` | no |

```php
$result = $enhance->servers->setWebsiteGeneratedRateLimitHourly('server-id');
```

## uninstallServerRole

Uninstall a server role

`DELETE /servers/{server_id}/roles/{role}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$role` | `ServerRole` | yes |
| `$disableRoleOnInstallation` | `?bool` | no |

```php
use GoSuccess\Enhance\Enum\ServerRole;

$result = $enhance->servers->uninstallServerRole('server-id', ServerRole::Email);
```

## updateAppcdScreenshotConfig

Update the screenshot config of the running appcd

`PATCH /servers/{server_id}/appcd/screenshot/config`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$screenshotConfigUpdate` | `ScreenshotConfigUpdate` | yes |

```php
use GoSuccess\Enhance\DTO\ScreenshotConfigUpdate;

$screenshotConfigUpdate = new ScreenshotConfigUpdate();
$screenshotConfigUpdate->enable = true;
$screenshotConfigUpdate->interval = 10;

$result = $enhance->servers->updateAppcdScreenshotConfig('server-id', $screenshotConfigUpdate);
```

## updateOwaspRules

Upgrade OWASP rules

`POST /v2/servers/{server_id}/owasp`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |

```php
$result = $enhance->servers->updateOwaspRules('server-id');
```

## updateServerGroup

Updates an existing server group's name

`PUT /servers/groups/{group_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$groupId` | `string` | yes |
| `$serverGroupUpdate` | `ServerGroupUpdate` | yes |

```php
use GoSuccess\Enhance\DTO\ServerGroupUpdate;

$serverGroupUpdate = new ServerGroupUpdate();
$serverGroupUpdate->name = 'example';

$result = $enhance->servers->updateServerGroup('group-id', $serverGroupUpdate);
```

## updateServerPrimaryIp

Updates the primary IP of the server in the database and in-memory metadata. This operation will not affect the IP used for service communication until the next restart of orchd. The new IP will be used for creation of new resources such as websites on this server but existing websites will not have their IP changed.

`PUT /servers/{server_id}/primary-ip`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->servers->updateServerPrimaryIp('server-id', 'example');
```

## updateServerPrimaryIpv6

Updates or sets the primary ipv6 address of the server. This endpoint will not change existing websites' DNS but the new record will be applied to all future zones.

`PUT /v2/servers/{server_id}/primary-ipv6`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$value` | `?string` | yes |

```php
$result = $enhance->servers->updateServerPrimaryIpv6('server-id', 'example');
```

## updateServerRole

Update server role

`PATCH /servers/{server_id}/roles/{role}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$role` | `ServerRole` | yes |
| `$body` | `mixed` | yes |
| `$disableRoleOnInstallation` | `?bool` | no |

```php
use GoSuccess\Enhance\Enum\ServerRole;

$result = $enhance->servers->updateServerRole('server-id', ServerRole::Email, null);
```

## updateSystemPackage

Updates a system package to its latest version.

`PUT /servers/{server_id}/packages/update`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$serverId` | `string` | yes |
| `$systemPackage` | `SystemPackage` | yes |
| `$systemPackageName` | `?SystemPackageName` | no |

```php
use GoSuccess\Enhance\DTO\SystemPackage;
use GoSuccess\Enhance\Enum\SystemPackageName;

$systemPackage = new SystemPackage();
$systemPackage->name = SystemPackageName::Appcd;

$result = $enhance->servers->updateSystemPackage('server-id', $systemPackage);
```

## validateRegistrationKey

Validate slave registration key

`POST /servers/registration-key/validate`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$key` | `?string` | no |

```php
$result = $enhance->servers->validateRegistrationKey();
```

