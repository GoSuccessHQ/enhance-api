# LicenceResource

Accessed via `$enhance->licence`.

| Method | Route |
| ------ | ----- |
| [`getLicenceInfo`](#getlicenceinfo) | `GET /licence` |
| [`refreshLicence`](#refreshlicence) | `PUT /licence` |

## getLicenceInfo

Get current licence status

`GET /licence`

```php
$result = $enhance->licence->getLicenceInfo();
```

## refreshLicence

Updates licence key if provided, and refresh licence status by calling home servers. NOTE: calling without any licence_key body, only refreshes the current licence status

`PUT /licence`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$licenceKey` | `?LicenceKey` | no |

```php
$result = $enhance->licence->refreshLicence();
```

