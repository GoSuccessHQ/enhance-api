# SslResource

Accessed via `$enhance->ssl`.

| Method | Route |
| ------ | ----- |
| [`getWebsiteDomainSslCert`](#getwebsitedomainsslcert) | `GET /v2/domains/{domain_id}/ssl` |
| [`getWebsiteMailDomainSslCert`](#getwebsitemaildomainsslcert) | `GET /v2/domains/{domain_id}/mail_ssl` |
| [`setWebsiteDomainForceSsl`](#setwebsitedomainforcessl) | `PUT /v2/domains/{domain_id}/ssl/force_ssl` |
| [`uploadWebsiteDomainSslCert`](#uploadwebsitedomainsslcert) | `POST /v2/domains/{domain_id}/ssl` |
| [`uploadWebsiteMailDomainSslCert`](#uploadwebsitemaildomainsslcert) | `POST /v2/domains/{domain_id}/mail_ssl` |

## getWebsiteDomainSslCert

Returns the SSL for this website domain

`GET /v2/domains/{domain_id}/ssl`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->ssl->getWebsiteDomainSslCert('example.com');
```

## getWebsiteMailDomainSslCert

Returns the SSL for this website domain with the mail.prefix

`GET /v2/domains/{domain_id}/mail_ssl`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->ssl->getWebsiteMailDomainSslCert('example.com');
```

## setWebsiteDomainForceSsl

Set "force ssl" status for domain mapping

`PUT /v2/domains/{domain_id}/ssl/force_ssl`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$value` | `?bool` | yes |

```php
$result = $enhance->ssl->setWebsiteDomainForceSsl('example.com', true);
```

## uploadWebsiteDomainSslCert

Upload custom ssl certificate, key and optional fullchain for a given website

`POST /v2/domains/{domain_id}/ssl`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$sslCert` | `SslCert` | yes |

```php
use GoSuccess\Enhance\DTO\SslCert;

$sslCert = new SslCert();
$sslCert->cert = 'example';
$sslCert->key = 'example';

$result = $enhance->ssl->uploadWebsiteDomainSslCert('example.com', $sslCert);
```

## uploadWebsiteMailDomainSslCert

Upload SSL for mail.customerdomain.

`POST /v2/domains/{domain_id}/mail_ssl`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |
| `$sslCert` | `SslCert` | yes |

```php
use GoSuccess\Enhance\DTO\SslCert;

$sslCert = new SslCert();
$sslCert->cert = 'example';
$sslCert->key = 'example';

$result = $enhance->ssl->uploadWebsiteMailDomainSslCert('example.com', $sslCert);
```

