# LetsencryptResource

Accessed via `$enhance->letsencrypt`.

| Method | Route |
| ------ | ----- |
| [`createWebsiteDomainLetsencryptCerts`](#createwebsitedomainletsencryptcerts) | `POST /v2/domains/{domain_id}/letsencrypt` |
| [`createWebsiteMailDomainLetsencryptCerts`](#createwebsitemaildomainletsencryptcerts) | `POST /v2/domains/{domain_id}/letsencrypt_mail` |
| [`performLetsEncryptPreflightCheck`](#performletsencryptpreflightcheck) | `POST /v2/domains/{domain_id}/letsencrypt_preflight` |

## createWebsiteDomainLetsencryptCerts

Generate and setup letsencrypt ssl certificates for website's domain

`POST /v2/domains/{domain_id}/letsencrypt`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->letsencrypt->createWebsiteDomainLetsencryptCerts('example.com');
```

## createWebsiteMailDomainLetsencryptCerts

Generate and setup letsencrypt ssl certificates for website's domain with mail. prefix.

`POST /v2/domains/{domain_id}/letsencrypt_mail`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->letsencrypt->createWebsiteMailDomainLetsencryptCerts('example.com');
```

## performLetsEncryptPreflightCheck

Perform the LetsEncrypt preflight check

`POST /v2/domains/{domain_id}/letsencrypt_preflight`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domainId` | `string` | yes |

```php
$result = $enhance->letsencrypt->performLetsEncryptPreflightCheck('example.com');
```

