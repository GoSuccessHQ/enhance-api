# OrgsResource

Accessed via `$enhance->orgs`.

| Method | Route |
| ------ | ----- |
| [`createCloudflareApiKey`](#createcloudflareapikey) | `POST /orgs/{org_id}/cloudflare` |
| [`deleteCloudflareApiKey`](#deletecloudflareapikey) | `DELETE /orgs/{org_id}/cloudflare/{cloudflare_key}` |
| [`deleteOrg`](#deleteorg) | `DELETE /orgs/{org_id}` |
| [`deleteOrgAvatar`](#deleteorgavatar) | `DELETE /orgs/{org_id}/avatar` |
| [`deleteOrgGithubApp`](#deleteorggithubapp) | `DELETE /orgs/{org_id}/github/app` |
| [`getCloudFlareKeyAffectedDomains`](#getcloudflarekeyaffecteddomains) | `GET /orgs/{org_id}/cloudflare/{cloudflare_key}` |
| [`getCloudflareApiKeys`](#getcloudflareapikeys) | `GET /orgs/{org_id}/cloudflare` |
| [`getCustomersAdded`](#getcustomersadded) | `GET /orgs/{org_id}/stats/customers/added` |
| [`getOrg`](#getorg) | `GET /orgs/{org_id}` |
| [`getOrgActivities`](#getorgactivities) | `GET /v2/orgs/{org_id}/activities` |
| [`getOrgGithubApp`](#getorggithubapp) | `GET /orgs/{org_id}/github/app` |
| [`getOrgGithubAppInfo`](#getorggithubappinfo) | `GET /orgs/{org_id}/github/repos` |
| [`getOrgGithubRepoRefs`](#getorggithubreporefs) | `GET /orgs/{org_id}/github/repositories/{repo_owner}/{repo_name}/refs` |
| [`getWebsitesAdded`](#getwebsitesadded) | `GET /orgs/{org_id}/stats/websites/added` |
| [`setOrgAvatar`](#setorgavatar) | `PUT /orgs/{org_id}/avatar` |
| [`updateCloudflareApiKey`](#updatecloudflareapikey) | `PUT /orgs/{org_id}/cloudflare/{cloudflare_key}` |
| [`updateOrg`](#updateorg) | `PATCH /orgs/{org_id}` |

## createCloudflareApiKey

Set CloudFlare API key, org level

`POST /orgs/{org_id}/cloudflare`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newCloudFlareToken` | `NewCloudFlareToken` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewCloudFlareToken;

$newCloudFlareToken = new NewCloudFlareToken();

$result = $enhance->orgs->createCloudflareApiKey($newCloudFlareToken);
```

## deleteCloudflareApiKey

Delete CloudFlare API key, org level

`DELETE /orgs/{org_id}/cloudflare/{cloudflare_key}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$cloudflareKey` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->deleteCloudflareApiKey('example');
```

## deleteOrg

Delete organization

`DELETE /orgs/{org_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$force` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->deleteOrg();
```

## deleteOrgAvatar

Remove org avatar

`DELETE /orgs/{org_id}/avatar`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->deleteOrgAvatar();
```

## deleteOrgGithubApp

Delete an organisation's GitHub app connection

`DELETE /orgs/{org_id}/github/app`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->deleteOrgGithubApp();
```

## getCloudFlareKeyAffectedDomains

Get affected domains for a CloudFlare key

`GET /orgs/{org_id}/cloudflare/{cloudflare_key}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$cloudflareKey` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->getCloudFlareKeyAffectedDomains('example');
```

## getCloudflareApiKeys

Get CloudFlare API keys, org level

`GET /orgs/{org_id}/cloudflare`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->getCloudflareApiKeys();
```

## getCustomersAdded

Get customers added over a given time period

`GET /orgs/{org_id}/stats/customers/added`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$timeInterval` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->getCustomersAdded();
```

## getOrg

Get organization info

`GET /orgs/{org_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->getOrg();
```

## getOrgActivities

Get organization's activity log.

`GET /v2/orgs/{org_id}/activities`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$createdBefore` | `?string` | no |
| `$createdAfter` | `?string` | no |
| `$activityKinds` | `?array` | no |
| `$anyEntityId` | `?array` | no |
| `$entityKind` | `?string` | no |
| `$search` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->getOrgActivities();
```

## getOrgGithubApp

Get an organisation's registered GitHub app

`GET /orgs/{org_id}/github/app`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->getOrgGithubApp();
```

## getOrgGithubAppInfo

Get the repositories of the registered GitHub app

`GET /orgs/{org_id}/github/repos`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->getOrgGithubAppInfo();
```

## getOrgGithubRepoRefs

List the tags and branches for a given repository

`GET /orgs/{org_id}/github/repositories/{repo_owner}/{repo_name}/refs`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$repoOwner` | `string` | yes |
| `$repoName` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->getOrgGithubRepoRefs('repo-owner', 'repo-name');
```

## getWebsitesAdded

Get websites added over a given time period

`GET /orgs/{org_id}/stats/websites/added`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$timeInterval` | `?string` | no |
| `$recursion` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->getWebsitesAdded();
```

## setOrgAvatar

Set org avatar

`PUT /orgs/{org_id}/avatar`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$formData` | `?array` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->orgs->setOrgAvatar();
```

## updateCloudflareApiKey

Update CloudFlare API key

`PUT /orgs/{org_id}/cloudflare/{cloudflare_key}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$cloudflareKey` | `string` | yes |
| `$updateCloudFlareApiKey` | `UpdateCloudFlareApiKey` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateCloudFlareApiKey;

$updateCloudFlareApiKey = new UpdateCloudFlareApiKey();
$updateCloudFlareApiKey->token = 'example';
$updateCloudFlareApiKey->friendlyName = 'example';

$result = $enhance->orgs->updateCloudflareApiKey('example', $updateCloudFlareApiKey);
```

## updateOrg

Update organization

`PATCH /orgs/{org_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgUpdate` | `OrgUpdate` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\OrgUpdate;
use GoSuccess\Enhance\Enum\Status;

$orgUpdate = new OrgUpdate();
$orgUpdate->name = 'example';
$orgUpdate->status = Status::Active;
$orgUpdate->isSuspended = true;
// ... set further properties as needed

$result = $enhance->orgs->updateOrg($orgUpdate);
```

