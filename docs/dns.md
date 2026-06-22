# DnsResource

Accessed via `$enhance->dns`.

| Method | Route |
| ------ | ----- |
| [`createDefaultDnsRecord`](#createdefaultdnsrecord) | `POST /v2/settings/dns/default-records` |
| [`createDnsThirdPartyProvider`](#creatednsthirdpartyprovider) | `POST /dns/third-party-providers` |
| [`createWebsiteDomainDnsZoneRecord`](#createwebsitedomaindnszonerecord) | `POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/records` |
| [`deleteDefaultDnsRecord`](#deletedefaultdnsrecord) | `DELETE /v2/settings/dns/default-records/{record_id}` |
| [`deleteDnsThirdPartyProvider`](#deletednsthirdpartyprovider) | `DELETE /dns/third-party-providers/{provider_id}` |
| [`deleteWebsiteDomainDnsZoneRecord`](#deletewebsitedomaindnszonerecord) | `DELETE /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/records/{record_id}` |
| [`disableDomainDnsSec`](#disabledomaindnssec) | `DELETE /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/dnssec` |
| [`enableDomainDnsSec`](#enabledomaindnssec) | `POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/dnssec` |
| [`getDnsThirdPartyProviders`](#getdnsthirdpartyproviders) | `GET /dns/third-party-providers` |
| [`getWebsiteDomainDnsZone`](#getwebsitedomaindnszone) | `GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone` |
| [`listDefaultDnsRecords`](#listdefaultdnsrecords) | `GET /v2/settings/dns/default-records` |
| [`updateDefaultDnsRecord`](#updatedefaultdnsrecord) | `PATCH /v2/settings/dns/default-records/{record_id}` |
| [`updateWebsiteDomainDnsZone`](#updatewebsitedomaindnszone) | `PATCH /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone` |
| [`updateWebsiteDomainDnsZoneRecord`](#updatewebsitedomaindnszonerecord) | `PATCH /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/records/{record_id}` |

## createDefaultDnsRecord

Create a default DNS record

`POST /v2/settings/dns/default-records`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newDefaultDnsRecord` | `NewDefaultDnsRecord` | yes |

```php
use GoSuccess\Enhance\DTO\NewDefaultDnsRecord;
use GoSuccess\Enhance\Enum\DnsRecordKind;

$newDefaultDnsRecord = new NewDefaultDnsRecord();
$newDefaultDnsRecord->kind = DnsRecordKind::A;
$newDefaultDnsRecord->name = 'example';
$newDefaultDnsRecord->value = 'example';
// ... set further properties as needed

$result = $enhance->dns->createDefaultDnsRecord($newDefaultDnsRecord);
```

## createDnsThirdPartyProvider

Create new third party provider.

`POST /dns/third-party-providers`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newDnsThirdPartyProvider` | `NewDnsThirdPartyProvider` | yes |

```php
use GoSuccess\Enhance\DTO\NewDnsThirdPartyProvider;

$newDnsThirdPartyProvider = new NewDnsThirdPartyProvider();
$newDnsThirdPartyProvider->url = 'example';

$result = $enhance->dns->createDnsThirdPartyProvider($newDnsThirdPartyProvider);
```

## createWebsiteDomainDnsZoneRecord

Create a new dns record for website domain

`POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/records`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$newDnsRecord` | `NewDnsRecord` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewDnsRecord;
use GoSuccess\Enhance\Enum\DnsRecordKind;

$newDnsRecord = new NewDnsRecord();
$newDnsRecord->kind = DnsRecordKind::A;
$newDnsRecord->name = 'example';
$newDnsRecord->value = 'example';
// ... set further properties as needed

$result = $enhance->dns->createWebsiteDomainDnsZoneRecord('website-id', 'example.com', $newDnsRecord);
```

## deleteDefaultDnsRecord

Delete a default DNS record

`DELETE /v2/settings/dns/default-records/{record_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$recordId` | `string` | yes |

```php
$result = $enhance->dns->deleteDefaultDnsRecord('record-id');
```

## deleteDnsThirdPartyProvider

Deletes a third party dns provider.

`DELETE /dns/third-party-providers/{provider_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$providerId` | `int` | yes |

```php
$result = $enhance->dns->deleteDnsThirdPartyProvider(123);
```

## deleteWebsiteDomainDnsZoneRecord

Delete dns zone record

`DELETE /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/records/{record_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$recordId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->dns->deleteWebsiteDomainDnsZoneRecord('website-id', 'example.com', 'record-id');
```

## disableDomainDnsSec

Disable DNSSEC on this domain

`DELETE /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/dnssec`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->dns->disableDomainDnsSec('website-id', 'example.com');
```

## enableDomainDnsSec

Enable DNSSEC on this domain

`POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/dnssec`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->dns->enableDomainDnsSec('website-id', 'example.com');
```

## getDnsThirdPartyProviders

Lists all third party providers.

`GET /dns/third-party-providers`

```php
$result = $enhance->dns->getDnsThirdPartyProviders();
```

## getWebsiteDomainDnsZone

Get a dns zone for given domain

`GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->dns->getWebsiteDomainDnsZone('website-id', 'example.com');
```

## listDefaultDnsRecords

List default DNS records

`GET /v2/settings/dns/default-records`

```php
$result = $enhance->dns->listDefaultDnsRecords();
```

## updateDefaultDnsRecord

Update a default DNS record

`PATCH /v2/settings/dns/default-records/{record_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$recordId` | `string` | yes |
| `$updateDefaultDnsRecord` | `UpdateDefaultDnsRecord` | yes |

```php
use GoSuccess\Enhance\DTO\UpdateDefaultDnsRecord;
use GoSuccess\Enhance\Enum\DnsRecordKind;

$updateDefaultDnsRecord = new UpdateDefaultDnsRecord();
$updateDefaultDnsRecord->kind = DnsRecordKind::A;
$updateDefaultDnsRecord->name = 'example';
$updateDefaultDnsRecord->value = 'example';
// ... set further properties as needed

$result = $enhance->dns->updateDefaultDnsRecord('record-id', $updateDefaultDnsRecord);
```

## updateWebsiteDomainDnsZone

Updates a dns zone SOA for website domain

`PATCH /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$updateDnsZone` | `UpdateDnsZone` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateDnsZone;

$updateDnsZone = new UpdateDnsZone();
$updateDnsZone->nameServer = 'example';
$updateDnsZone->adminEmail = 'user@example.com';
$updateDnsZone->expire = 10;
// ... set further properties as needed

$result = $enhance->dns->updateWebsiteDomainDnsZone('website-id', 'example.com', $updateDnsZone);
```

## updateWebsiteDomainDnsZoneRecord

Updates a dns record for given domain

`PATCH /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/records/{record_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$recordId` | `string` | yes |
| `$updateDnsRecord` | `UpdateDnsRecord` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateDnsRecord;
use GoSuccess\Enhance\Enum\DnsRecordKind;

$updateDnsRecord = new UpdateDnsRecord();
$updateDnsRecord->kind = DnsRecordKind::A;
$updateDnsRecord->name = 'example';
$updateDnsRecord->value = 'example';
// ... set further properties as needed

$result = $enhance->dns->updateWebsiteDomainDnsZoneRecord('website-id', 'example.com', 'record-id', $updateDnsRecord);
```

