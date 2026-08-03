# EmailClientResource

Accessed via `$enhance->emailClient`.

These endpoints act on behalf of a single mailbox rather than an organization.
On top of the configured access token, every one of them requires the mailbox
address and its current password, which the client sends as the `Address` and
`Password` headers.

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

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$address` | `string` | yes |
| `$password` | `string` | yes |

```php
$result = $enhance->emailClient->GetEmailForwarders('info@example.test', 's3cret');
```

## GetEmailPublicIp

Returns public Ip Address of the email server

`GET /email-client/public-ip`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$address` | `string` | yes |
| `$password` | `string` | yes |

```php
$result = $enhance->emailClient->GetEmailPublicIp('info@example.test', 's3cret');
```

## UpdateEmailForwarders

Updates email account's forwarders

`PUT /email-client/forwarders`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$emailForwardersUpdate` | `EmailForwardersUpdate` | yes |
| `$address` | `string` | yes |
| `$password` | `string` | yes |

```php
use GoSuccess\Enhance\DTO\EmailForwardersUpdate;

$emailForwardersUpdate = new EmailForwardersUpdate();

$result = $enhance->emailClient->UpdateEmailForwarders($emailForwardersUpdate, 'info@example.test', 's3cret');
```

## UpdateEmailPassword

Updates email account's password

`PUT /email-client/password`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$emailPasswordUpdate` | `EmailPasswordUpdate` | yes |
| `$address` | `string` | yes |
| `$password` | `string` | yes |

The `$password` argument authenticates the request and is therefore the
account's *current* password; the new one goes into the request body.

```php
use GoSuccess\Enhance\DTO\EmailPasswordUpdate;

$emailPasswordUpdate = new EmailPasswordUpdate();
$emailPasswordUpdate->password = 'n3w-s3cret';

$result = $enhance->emailClient->UpdateEmailPassword($emailPasswordUpdate, 'info@example.test', 's3cret');
```

## createEmailAutoresponder

Create new email autoresponder

`POST /email-client/autoresponders`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newAutoresponder` | `NewAutoresponder` | yes |
| `$address` | `string` | yes |
| `$password` | `string` | yes |

```php
use GoSuccess\Enhance\DTO\NewAutoresponder;

$newAutoresponder = new NewAutoresponder();
$newAutoresponder->enabled = true;
$newAutoresponder->subject = 'example';
$newAutoresponder->body = 'example';

$result = $enhance->emailClient->createEmailAutoresponder($newAutoresponder, 'info@example.test', 's3cret');
```

## deleteEmailAutoresponder

Delete email autoresponder

`DELETE /email-client/autoresponders/{autoresponder_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$autoresponderId` | `string` | yes |
| `$address` | `string` | yes |
| `$password` | `string` | yes |

```php
$result = $enhance->emailClient->deleteEmailAutoresponder('autoresponder-id', 'info@example.test', 's3cret');
```

## getEmailAutoresponders

Get email account autoresponder

`GET /email-client/autoresponders`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$address` | `string` | yes |
| `$password` | `string` | yes |

```php
$result = $enhance->emailClient->getEmailAutoresponders('info@example.test', 's3cret');
```

## updateEmailAutoresponder

Update email autoresponder

`PUT /email-client/autoresponders/{autoresponder_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$autoresponderId` | `string` | yes |
| `$updateAutoresponder` | `UpdateAutoresponder` | yes |
| `$address` | `string` | yes |
| `$password` | `string` | yes |

```php
use GoSuccess\Enhance\DTO\UpdateAutoresponder;

$updateAutoresponder = new UpdateAutoresponder();
$updateAutoresponder->enabled = true;
$updateAutoresponder->subject = 'example';
$updateAutoresponder->body = 'example';

$result = $enhance->emailClient->updateEmailAutoresponder('autoresponder-id', $updateAutoresponder, 'info@example.test', 's3cret');
```
