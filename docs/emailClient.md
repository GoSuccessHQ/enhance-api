# EmailClientResource

Accessed via `$enhance->emailClient`.

| Method | Route |
| ------ | ----- |
| [`GetEmailForwarders`](#getemailforwarders) | `GET /email-client/forwarders` |
| [`GetEmailPublicIp`](#getemailpublicip) | `GET /email-client/public-ip` |
| [`UpdateEmailForwarders`](#updateemailforwarders) | `PUT /email-client/forwarders` |
| [`UpdateEmailPassword`](#updateemailpassword) | `PUT /email-client/password` |
| [`createEmailAutoresponder`](#createemailautoresponder) | `POST /email-client/autoresponders` |
| [`deleteEmailAutoresponder`](#deleteemailautoresponder) | `DELETE /email-client/autoresponders/{autoresponder_id}` |
| [`getEmailAutoresponders`](#getemailautoresponders) | `GET /email-client/autoresponders` |
| [`updateEmailAutoresponder`](#updateemailautoresponder) | `PUT /email-client/autoresponders/{autoresponder_id}` |

## GetEmailForwarders

Returns email account's forwarders

`GET /email-client/forwarders`

```php
$result = $enhance->emailClient->GetEmailForwarders();
```

## GetEmailPublicIp

Returns public Ip Address of the email server

`GET /email-client/public-ip`

```php
$result = $enhance->emailClient->GetEmailPublicIp();
```

## UpdateEmailForwarders

Updates email account's forwarders

`PUT /email-client/forwarders`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$emailForwardersUpdate` | `EmailForwardersUpdate` | yes |

```php
use GoSuccess\Enhance\DTO\EmailForwardersUpdate;

$emailForwardersUpdate = new EmailForwardersUpdate();

$result = $enhance->emailClient->UpdateEmailForwarders($emailForwardersUpdate);
```

## UpdateEmailPassword

Updates email account's password

`PUT /email-client/password`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$emailPasswordUpdate` | `EmailPasswordUpdate` | yes |

```php
use GoSuccess\Enhance\DTO\EmailPasswordUpdate;

$emailPasswordUpdate = new EmailPasswordUpdate();
$emailPasswordUpdate->password = 's3cret';

$result = $enhance->emailClient->UpdateEmailPassword($emailPasswordUpdate);
```

## createEmailAutoresponder

Create new email autoresponder

`POST /email-client/autoresponders`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newAutoresponder` | `NewAutoresponder` | yes |

```php
use GoSuccess\Enhance\DTO\NewAutoresponder;

$newAutoresponder = new NewAutoresponder();
$newAutoresponder->enabled = true;
$newAutoresponder->subject = 'example';
$newAutoresponder->body = 'example';

$result = $enhance->emailClient->createEmailAutoresponder($newAutoresponder);
```

## deleteEmailAutoresponder

Delete email autoresponder

`DELETE /email-client/autoresponders/{autoresponder_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$autoresponderId` | `string` | yes |

```php
$result = $enhance->emailClient->deleteEmailAutoresponder('autoresponder-id');
```

## getEmailAutoresponders

Get email account autoresponder

`GET /email-client/autoresponders`

```php
$result = $enhance->emailClient->getEmailAutoresponders();
```

## updateEmailAutoresponder

Update email autoresponder

`PUT /email-client/autoresponders/{autoresponder_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$autoresponderId` | `string` | yes |
| `$updateAutoresponder` | `UpdateAutoresponder` | yes |

```php
use GoSuccess\Enhance\DTO\UpdateAutoresponder;

$updateAutoresponder = new UpdateAutoresponder();
$updateAutoresponder->enabled = true;
$updateAutoresponder->subject = 'example';
$updateAutoresponder->body = 'example';

$result = $enhance->emailClient->updateEmailAutoresponder('autoresponder-id', $updateAutoresponder);
```

