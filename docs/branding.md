# BrandingResource

Accessed via `$enhance->branding`.

| Method | Route |
| ------ | ----- |
| [`createBrandingSettings`](#createbrandingsettings) | `POST /orgs/{org_id}/branding/settings` |
| [`createNameServerDomain`](#createnameserverdomain) | `POST /orgs/{org_id}/name-servers` |
| [`deleteBrandFavicon`](#deletebrandfavicon) | `DELETE /orgs/{org_id}/branding/favicon` |
| [`deleteBrandInverseIcon`](#deletebrandinverseicon) | `DELETE /orgs/{org_id}/branding/inverse-icon` |
| [`deleteBrandLoginImage`](#deletebrandloginimage) | `DELETE /orgs/{org_id}/branding/login-image` |
| [`deleteBrandLogo`](#deletebrandlogo) | `DELETE /orgs/{org_id}/branding/logo` |
| [`deleteBrandingSetting`](#deletebrandingsetting) | `DELETE /orgs/{org_id}/branding/settings/{name}` |
| [`deleteInverseBrandLogo`](#deleteinversebrandlogo) | `DELETE /orgs/{org_id}/branding/inverse-logo` |
| [`deleteNameServerDomain`](#deletenameserverdomain) | `DELETE /orgs/{org_id}/name-servers/{domain}` |
| [`getBranding`](#getbranding) | `GET /branding` |
| [`getBrandingSetting`](#getbrandingsetting) | `GET /orgs/{org_id}/branding/settings/{name}` |
| [`getBrandingSettings`](#getbrandingsettings) | `GET /orgs/{org_id}/branding/settings` |
| [`getStagingDomain`](#getstagingdomain) | `GET /orgs/{org_id}/staging-domain` |
| [`setBrandFavicon`](#setbrandfavicon) | `PUT /orgs/{org_id}/branding/favicon` |
| [`setBrandInverseIcon`](#setbrandinverseicon) | `PUT /orgs/{org_id}/branding/inverse-icon` |
| [`setBrandInverseLogo`](#setbrandinverselogo) | `PUT /orgs/{org_id}/branding/inverse-logo` |
| [`setBrandLoginImage`](#setbrandloginimage) | `PUT /orgs/{org_id}/branding/login-image` |
| [`setBrandLogo`](#setbrandlogo) | `PUT /orgs/{org_id}/branding/logo` |
| [`setStagingDomain`](#setstagingdomain) | `POST /orgs/{org_id}/staging-domain` |
| [`updateBrandingSetting`](#updatebrandingsetting) | `PUT /orgs/{org_id}/branding/settings/{name}` |
| [`updateNameServerDomain`](#updatenameserverdomain) | `PATCH /orgs/{org_id}/name-servers/{domain}` |

## createBrandingSettings

Create branding settings

`POST /orgs/{org_id}/branding/settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$items` | `?array` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->createBrandingSettings([]);
```

## createNameServerDomain

Create reseller name server domain

`POST /orgs/{org_id}/name-servers`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newDomain` | `NewDomain` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewDomain;

$newDomain = new NewDomain();
$newDomain->domain = 'example.com';

$result = $enhance->branding->createNameServerDomain($newDomain);
```

## deleteBrandFavicon

Delete brand favicon

`DELETE /orgs/{org_id}/branding/favicon`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->deleteBrandFavicon();
```

## deleteBrandInverseIcon

Delete brand inverse icon

`DELETE /orgs/{org_id}/branding/inverse-icon`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->deleteBrandInverseIcon();
```

## deleteBrandLoginImage

Delete brand login image

`DELETE /orgs/{org_id}/branding/login-image`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->deleteBrandLoginImage();
```

## deleteBrandLogo

Delete brand logo

`DELETE /orgs/{org_id}/branding/logo`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->deleteBrandLogo();
```

## deleteBrandingSetting

Remove the specified setting

`DELETE /orgs/{org_id}/branding/settings/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$name` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->deleteBrandingSetting('example');
```

## deleteInverseBrandLogo

Delete brand inverse logo

`DELETE /orgs/{org_id}/branding/inverse-logo`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->deleteInverseBrandLogo();
```

## deleteNameServerDomain

Delete reseller name server domain name

`DELETE /orgs/{org_id}/name-servers/{domain}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domain` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->deleteNameServerDomain('example.com');
```

## getBranding

Get default branding

`GET /branding`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->getBranding();
```

## getBrandingSetting

Get the specified setting

`GET /orgs/{org_id}/branding/settings/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$name` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->getBrandingSetting('example');
```

## getBrandingSettings

Get all current settings

`GET /orgs/{org_id}/branding/settings`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->getBrandingSettings();
```

## getStagingDomain

Fetches the staging domain which is currently set

`GET /orgs/{org_id}/staging-domain`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->getStagingDomain();
```

## setBrandFavicon

Set brand favicon

`PUT /orgs/{org_id}/branding/favicon`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$formData` | `?array` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->setBrandFavicon();
```

## setBrandInverseIcon

Set brand inverse icon

`PUT /orgs/{org_id}/branding/inverse-icon`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$formData` | `?array` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->setBrandInverseIcon();
```

## setBrandInverseLogo

Set brand inverse logo

`PUT /orgs/{org_id}/branding/inverse-logo`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$formData` | `?array` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->setBrandInverseLogo();
```

## setBrandLoginImage

Set brand login image

`PUT /orgs/{org_id}/branding/login-image`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$formData` | `?array` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->setBrandLoginImage();
```

## setBrandLogo

Set brand logo

`PUT /orgs/{org_id}/branding/logo`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$formData` | `?array` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->setBrandLogo();
```

## setStagingDomain

Set or update domain suffix for staging websites created by customers

`POST /orgs/{org_id}/staging-domain`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$stagingDomain` | `StagingDomain` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\StagingDomain;

$stagingDomain = new StagingDomain();
$stagingDomain->domain = 'example.com';

$result = $enhance->branding->setStagingDomain($stagingDomain);
```

## updateBrandingSetting

Create or update the specified setting

`PUT /orgs/{org_id}/branding/settings/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$name` | `string` | yes |
| `$value` | `?string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->branding->updateBrandingSetting('example', 'example');
```

## updateNameServerDomain

Update reseller name server domain name

`PATCH /orgs/{org_id}/name-servers/{domain}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$domain` | `string` | yes |
| `$newDomain` | `NewDomain` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewDomain;

$newDomain = new NewDomain();
$newDomain->domain = 'example.com';

$result = $enhance->branding->updateNameServerDomain('example.com', $newDomain);
```

