# DomainsResource

Accessed via `$enhance->domains`.

| Method | Route |
| ------ | ----- |
| [`checkDomain`](#checkdomain) | `POST /orgs/{org_id}/domains/check` |
| [`deleteCloudflareApiKeyId`](#deletecloudflareapikeyid) | `DELETE /orgs/{org_id}/domains/{domain_id}/cloudflare` |
| [`deleteDomain`](#deletedomain) | `DELETE /orgs/{org_id}/domains/{domain_id}` |
| [`deleteWebsiteDomainVhost`](#deletewebsitedomainvhost) | `DELETE /v2/domains/{domain_id}/vhost` |
| [`getCloudflareApiKeyDomain`](#getcloudflareapikeydomain) | `GET /orgs/{org_id}/domains/{domain_id}/cloudflare` |
| [`getCloudflareNameServers`](#getcloudflarenameservers) | `GET /orgs/{org_id}/domains/{domain_id}/cloudflare/nameservers` |
| [`getDomainAuthNs`](#getdomainauthns) | `GET /orgs/{org_id}/domains/{domain_id}/auth-ns` |
| [`getDomains`](#getdomains) | `GET /orgs/{org_id}/domains` |
| [`getWebsiteDomainModSecStatus`](#getwebsitedomainmodsecstatus) | `GET /v2/domains/{domain_id}/modsec_status` |
| [`getWebsiteDomainVhost`](#getwebsitedomainvhost) | `GET /v2/domains/{domain_id}/vhost` |
| [`setCloudflareApiKeyId`](#setcloudflareapikeyid) | `PUT /orgs/{org_id}/domains/{domain_id}/cloudflare` |
| [`setWebsiteDomainModSecStatus`](#setwebsitedomainmodsecstatus) | `PUT /v2/domains/{domain_id}/modsec_status` |
| [`setWebsiteDomainVhost`](#setwebsitedomainvhost) | `PUT /v2/domains/{domain_id}/vhost` |

## checkDomain

Check if a domain can be created

`POST /orgs/{org_id}/domains/check`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newDomain` | `NewDomain` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewDomain;

$newDomain = new NewDomain();
$newDomain->domain = 'example.com';

$result = $enhance->domains->checkDomain($newDomain);
```

## deleteCloudflareApiKeyId

Delete CloudFlare API key, domain level

`DELETE /orgs/{org_id}/domains/{domain_id}/cloudflare`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->domains->deleteCloudflareApiKeyId('example.com');
```

## deleteDomain

Delete domain

`DELETE /orgs/{org_id}/domains/{domain_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->domains->deleteDomain('example.com');
```

## deleteWebsiteDomainVhost

Deletes domain's custom vhost file if any

`DELETE /v2/domains/{domain_id}/vhost`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$body` | `mixed` | yes |

```php
$result = $enhance->domains->deleteWebsiteDomainVhost('example.com', null);
```

## getCloudflareApiKeyDomain

Get CloudFlare API key, domain level

`GET /orgs/{org_id}/domains/{domain_id}/cloudflare`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->domains->getCloudflareApiKeyDomain('example.com');
```

## getCloudflareNameServers

Get CloudFlare name servers

`GET /orgs/{org_id}/domains/{domain_id}/cloudflare/nameservers`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->domains->getCloudflareNameServers('example.com');
```

## getDomainAuthNs

Get authoritative nameservers for domain.

`GET /orgs/{org_id}/domains/{domain_id}/auth-ns`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->domains->getDomainAuthNs('example.com');
```

## getDomains

Get domains

`GET /orgs/{org_id}/domains`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortBy` | `?string` | no |
| `$sortOrder` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->domains->getDomains();
```

## getWebsiteDomainModSecStatus

Get mod security status for a single domain

`GET /v2/domains/{domain_id}/modsec_status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->domains->getWebsiteDomainModSecStatus('example.com');
```

## getWebsiteDomainVhost

Get domain's custom vhost file, if the file does not exist return empty string

`GET /v2/domains/{domain_id}/vhost`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->domains->getWebsiteDomainVhost('example.com');
```

## setCloudflareApiKeyId

Set CloudFlare API key, domain level

`PUT /orgs/{org_id}/domains/{domain_id}/cloudflare`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$value` | `?string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->domains->setCloudflareApiKeyId('example.com', 'example');
```

## setWebsiteDomainModSecStatus

Set mod security status on a single domain

`PUT /v2/domains/{domain_id}/modsec_status`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$modSecStatus` | `ModSecStatus` | yes |

```php
use GoSuccess\Enhance\DTO\ModSecStatus;

$modSecStatus = new ModSecStatus();
$modSecStatus->enabled = true;

$result = $enhance->domains->setWebsiteDomainModSecStatus('example.com', $modSecStatus);
```

## setWebsiteDomainVhost

Set a custom vhost file

`PUT /v2/domains/{domain_id}/vhost`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$vhost` | `Vhost` | yes |

```php
use GoSuccess\Enhance\DTO\Vhost;
use GoSuccess\Enhance\Enum\VhostWebserverKind;

$vhost = new Vhost();
$vhost->contents = 'example';
$vhost->webserver = VhostWebserverKind::Apache;

$result = $enhance->domains->setWebsiteDomainVhost('example.com', $vhost);
```

