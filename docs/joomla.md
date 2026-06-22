# JoomlaResource

Accessed via `$enhance->joomla`.

| Method | Route |
| ------ | ----- |
| [`createJoomlaUser`](#createjoomlauser) | `POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users` |
| [`deleteJoomlaUser`](#deletejoomlauser) | `DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}` |
| [`getJoomlaInfo`](#getjoomlainfo) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/info` |
| [`getJoomlaUsers`](#getjoomlausers) | `GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users` |
| [`resetJoomlaUserPassword`](#resetjoomlauserpassword) | `PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}/password` |
| [`updateJoomlaEmailAddress`](#updatejoomlaemailaddress) | `PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}/email` |
| [`updateJoomlaUsername`](#updatejoomlausername) | `PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}/username` |

## createJoomlaUser

Create website Joomla user

`POST /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$newJoomlaUser` | `NewJoomlaUser` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewJoomlaUser;

$newJoomlaUser = new NewJoomlaUser();
$newJoomlaUser->username = 'example';
$newJoomlaUser->password = 's3cret';
$newJoomlaUser->email = 'user@example.com';

$result = $enhance->joomla->createJoomlaUser('website-id', 'app-id', $newJoomlaUser);
```

## deleteJoomlaUser

Delete a joomla user

`DELETE /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$username` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->joomla->deleteJoomlaUser('website-id', 'app-id', 'example');
```

## getJoomlaInfo

Get Joomla installation info

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/info`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->joomla->getJoomlaInfo('website-id', 'app-id');
```

## getJoomlaUsers

List all users of a Joomla installation

`GET /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->joomla->getJoomlaUsers('website-id', 'app-id');
```

## resetJoomlaUserPassword

Set the password for a given username

`PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}/password`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$username` | `string` | yes |
| `$value` | `?string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->joomla->resetJoomlaUserPassword('website-id', 'app-id', 'example', 'example');
```

## updateJoomlaEmailAddress

Update the email address for a given username

`PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}/email`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$username` | `string` | yes |
| `$value` | `?string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->joomla->updateJoomlaEmailAddress('website-id', 'app-id', 'example', 'example');
```

## updateJoomlaUsername

Update the username for a given username

`PUT /orgs/{org_id}/websites/{website_id}/apps/{app_id}/joomla/users/{username}/username`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$appId` | `string` | yes |
| `$username` | `string` | yes |
| `$value` | `?string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->joomla->updateJoomlaUsername('website-id', 'app-id', 'example', 'example');
```

