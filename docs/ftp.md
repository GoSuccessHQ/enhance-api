# FtpResource

Accessed via `$enhance->ftp`.

| Method | Route |
| ------ | ----- |
| [`createFtpUser`](#createftpuser) | `POST /orgs/{org_id}/websites/{website_id}/ftp/users` |
| [`deleteFtpUser`](#deleteftpuser) | `DELETE /orgs/{org_id}/websites/{website_id}/ftp/users/{username}` |
| [`getFtpUsers`](#getftpusers) | `GET /orgs/{org_id}/websites/{website_id}/ftp/users` |
| [`updateFtpUser`](#updateftpuser) | `PATCH /orgs/{org_id}/websites/{website_id}/ftp/users/{username}` |

## createFtpUser

Creates a new FTP user for a given website

`POST /orgs/{org_id}/websites/{website_id}/ftp/users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$newFtpUser` | `NewFtpUser` | yes |
| `$createHome` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewFtpUser;

$newFtpUser = new NewFtpUser();
$newFtpUser->account = 'example';
$newFtpUser->password = 's3cret';
$newFtpUser->homeDir = 'example';

$result = $enhance->ftp->createFtpUser('website-id', $newFtpUser);
```

## deleteFtpUser

Deletes given FTP user

`DELETE /orgs/{org_id}/websites/{website_id}/ftp/users/{username}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$deleteHome` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->ftp->deleteFtpUser('website-id', 'example');
```

## getFtpUsers

Returns all ftp users data for a given website

`GET /orgs/{org_id}/websites/{website_id}/ftp/users`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->ftp->getFtpUsers('website-id');
```

## updateFtpUser

Update given FTP user

`PATCH /orgs/{org_id}/websites/{website_id}/ftp/users/{username}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$username` | `string` | yes |
| `$ftpUserUpdate` | `FtpUserUpdate` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\FtpUserUpdate;

$ftpUserUpdate = new FtpUserUpdate();
$ftpUserUpdate->homeDir = 'example';
$ftpUserUpdate->password = 's3cret';

$result = $enhance->ftp->updateFtpUser('website-id', 'example', $ftpUserUpdate);
```

