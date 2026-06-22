# MembersResource

Accessed via `$enhance->members`.

| Method | Route |
| ------ | ----- |
| [`createAccessToken`](#createaccesstoken) | `POST /orgs/{org_id}/access_tokens` |
| [`createMember`](#createmember) | `POST /orgs/{org_id}/members` |
| [`deleteAccessToken`](#deleteaccesstoken) | `DELETE /orgs/{org_id}/access_tokens/{token_id}` |
| [`deleteMember`](#deletemember) | `DELETE /orgs/{org_id}/members/{member_id}` |
| [`getAccessTokens`](#getaccesstokens) | `GET /orgs/{org_id}/access_tokens` |
| [`getMember`](#getmember) | `GET /orgs/{org_id}/members/{member_id}` |
| [`getMembers`](#getmembers) | `GET /orgs/{org_id}/members` |
| [`getOrgMemberLogin`](#getorgmemberlogin) | `GET /orgs/{org_id}/members/{member_id}/sso` |
| [`updateAccessToken`](#updateaccesstoken) | `PATCH /orgs/{org_id}/access_tokens/{token_id}` |
| [`updateMember`](#updatemember) | `PUT /orgs/{org_id}/members/{member_id}` |

## createAccessToken

Create organisation access token

`POST /orgs/{org_id}/access_tokens`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newAccessToken` | `NewAccessToken` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewAccessToken;

$newAccessToken = new NewAccessToken();
$newAccessToken->friendlyName = 'example';
$newAccessToken->ipRestricted = true;

$result = $enhance->members->createAccessToken($newAccessToken);
```

## createMember

Create organization member

`POST /orgs/{org_id}/members`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newMember` | `NewMember` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewMember;

$newMember = new NewMember();
$newMember->loginId = 'login-id';

$result = $enhance->members->createMember($newMember);
```

## deleteAccessToken

Delete access token member

`DELETE /orgs/{org_id}/access_tokens/{token_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$tokenId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->members->deleteAccessToken('token-id');
```

## deleteMember

Delete organization member

`DELETE /orgs/{org_id}/members/{member_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$memberId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->members->deleteMember('member-id');
```

## getAccessTokens

Get access token members

`GET /orgs/{org_id}/access_tokens`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->members->getAccessTokens();
```

## getMember

Get organization member

`GET /orgs/{org_id}/members/{member_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$memberId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->members->getMember('member-id');
```

## getMembers

Get organization members

`GET /orgs/{org_id}/members`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortBy` | `?string` | no |
| `$sortOrder` | `?string` | no |
| `$role` | `?Role` | no |
| `$siteAccess` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->members->getMembers();
```

## getOrgMemberLogin

Get a One-Time-Password link for the member

`GET /orgs/{org_id}/members/{member_id}/sso`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$memberId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->members->getOrgMemberLogin('member-id');
```

## updateAccessToken

Update access token

`PATCH /orgs/{org_id}/access_tokens/{token_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$tokenId` | `string` | yes |
| `$updateAccessToken` | `UpdateAccessToken` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateAccessToken;

$updateAccessToken = new UpdateAccessToken();
$updateAccessToken->friendlyName = 'example';
$updateAccessToken->ipRestricted = true;

$result = $enhance->members->updateAccessToken('token-id', $updateAccessToken);
```

## updateMember

Overwrite organization member settings

`PUT /orgs/{org_id}/members/{member_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$memberId` | `string` | yes |
| `$updateMember` | `UpdateMember` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateMember;

$updateMember = new UpdateMember();

$result = $enhance->members->updateMember('member-id', $updateMember);
```

