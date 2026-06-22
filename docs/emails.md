# EmailsResource

Accessed via `$enhance->emails`.

| Method | Route |
| ------ | ----- |
| [`createWebsiteEmail`](#createwebsiteemail) | `POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/emails` |
| [`createWebsiteEmailAutoresponder`](#createwebsiteemailautoresponder) | `POST /orgs/{org_id}/websites/{website_id}/emails/{email_address}/autoresponder` |
| [`deleteWebsiteEmail`](#deletewebsiteemail) | `DELETE /orgs/{org_id}/websites/{website_id}/emails/{email_address}` |
| [`deleteWebsiteEmailAutoresponder`](#deletewebsiteemailautoresponder) | `DELETE /orgs/{org_id}/websites/{website_id}/emails/{email_address}/autoresponder` |
| [`getDomainEmailAuth`](#getdomainemailauth) | `GET /websites/{website_id}/domains/{domain_name}/email-auth` |
| [`getDomainLocalRemote`](#getdomainlocalremote) | `GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/local_remote` |
| [`getEmailSpamThresholds`](#getemailspamthresholds) | `GET /websites/{website_id}/emails/{email_address}/spam_thresholds` |
| [`getEmails`](#getemails) | `GET /orgs/{org_id}/emails` |
| [`getWebsiteEmail`](#getwebsiteemail) | `GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}` |
| [`getWebsiteEmailAutoresponder`](#getwebsiteemailautoresponder) | `GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}/autoresponder` |
| [`getWebsiteEmailClientConf`](#getwebsiteemailclientconf) | `GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}/client-conf` |
| [`getWebsiteEmails`](#getwebsiteemails) | `GET /orgs/{org_id}/websites/{website_id}/emails` |
| [`setDomainLocalRemote`](#setdomainlocalremote) | `PUT /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/local_remote` |
| [`setEmailSpamThresholds`](#setemailspamthresholds) | `PUT /websites/{website_id}/emails/{email_address}/spam_thresholds` |
| [`ssoToRoundcube`](#ssotoroundcube) | `GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}/sso` |
| [`updateDomainEmailAuth`](#updatedomainemailauth) | `PUT /websites/{website_id}/domains/{domain_name}/email-auth` |
| [`updateWebsiteEmail`](#updatewebsiteemail) | `PATCH /orgs/{org_id}/websites/{website_id}/emails/{email_address}` |
| [`validateDomainEmailAuth`](#validatedomainemailauth) | `GET /websites/{website_id}/domains/{domain_name}/email-auth/validate` |

## createWebsiteEmail

Create an email under website's domain

`POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/emails`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$newEmail` | `NewEmail` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewEmail;

$newEmail = new NewEmail();
$newEmail->mailboxName = 'example';
$newEmail->mailboxPassword = 's3cret';
$newEmail->username = 'example';
// ... set further properties as needed

$result = $enhance->emails->createWebsiteEmail('website-id', 'example.com', $newEmail);
```

## createWebsiteEmailAutoresponder

Create new website email autoresponder

`POST /orgs/{org_id}/websites/{website_id}/emails/{email_address}/autoresponder`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |
| `$newAutoresponder` | `NewAutoresponder` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewAutoresponder;

$newAutoresponder = new NewAutoresponder();
$newAutoresponder->enabled = true;
$newAutoresponder->subject = 'example';
$newAutoresponder->body = 'example';

$result = $enhance->emails->createWebsiteEmailAutoresponder('website-id', 'user@example.com', $newAutoresponder);
```

## deleteWebsiteEmail

Delete website email

`DELETE /orgs/{org_id}/websites/{website_id}/emails/{email_address}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->emails->deleteWebsiteEmail('website-id', 'user@example.com');
```

## deleteWebsiteEmailAutoresponder

Delete website email autoresponder

`DELETE /orgs/{org_id}/websites/{website_id}/emails/{email_address}/autoresponder`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->emails->deleteWebsiteEmailAutoresponder('website-id', 'user@example.com');
```

## getDomainEmailAuth

Get email authentication preferences

`GET /websites/{website_id}/domains/{domain_name}/email-auth`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainName` | `string` | yes |

```php
$result = $enhance->emails->getDomainEmailAuth('website-id', 'example.com');
```

## getDomainLocalRemote

Get the current local/remote status

`GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/local_remote`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->emails->getDomainLocalRemote('website-id', 'example.com');
```

## getEmailSpamThresholds

Get spam thresholds for an email address

`GET /websites/{website_id}/emails/{email_address}/spam_thresholds`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |

```php
$result = $enhance->emails->getEmailSpamThresholds('website-id', 'user@example.com');
```

## getEmails

Get org emails

`GET /orgs/{org_id}/emails`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortBy` | `?string` | no |
| `$sortOrder` | `?string` | no |
| `$search` | `?string` | no |
| `$recursive` | `?bool` | no |
| `$maxDepth` | `?int` | no |
| `$status` | `?WebsiteStatus` | no |
| `$domainId` | `?string` | no |
| `$planId` | `?int` | no |
| `$subscriptionId` | `?int` | no |
| `$includeInternal` | `?bool` | no |
| `$showDeleted` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->emails->getEmails();
```

## getWebsiteEmail

Get website email

`GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->emails->getWebsiteEmail('website-id', 'user@example.com');
```

## getWebsiteEmailAutoresponder

Get website email autoresponder

`GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}/autoresponder`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->emails->getWebsiteEmailAutoresponder('website-id', 'user@example.com');
```

## getWebsiteEmailClientConf

Get website email client configuration

`GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}/client-conf`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->emails->getWebsiteEmailClientConf('website-id', 'user@example.com');
```

## getWebsiteEmails

Get website emails

`GET /orgs/{org_id}/websites/{website_id}/emails`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$sortBy` | `?string` | no |
| `$sortOrder` | `?string` | no |
| `$search` | `?string` | no |
| `$includeInternal` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->emails->getWebsiteEmails('website-id');
```

## setDomainLocalRemote

Update email local/remote status

`PUT /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/local_remote`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainId` | `string` | yes |
| `$localRemoteBody` | `LocalRemoteBody` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\LocalRemoteBody;
use GoSuccess\Enhance\Enum\LocalRemote;

$localRemoteBody = new LocalRemoteBody();
$localRemoteBody->localRemote = LocalRemote::Local;

$result = $enhance->emails->setDomainLocalRemote('website-id', 'example.com', $localRemoteBody);
```

## setEmailSpamThresholds

Set spam thresholds for an email address

`PUT /websites/{website_id}/emails/{email_address}/spam_thresholds`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |
| `$spamThresholds` | `SpamThresholds` | yes |

```php
use GoSuccess\Enhance\DTO\SpamThresholds;

$spamThresholds = new SpamThresholds();
$spamThresholds->greylist = 1.0;
$spamThresholds->reject = 1.0;
$spamThresholds->spambox = 1.0;

$result = $enhance->emails->setEmailSpamThresholds('website-id', 'user@example.com', $spamThresholds);
```

## ssoToRoundcube

SSO to Roundcube

`GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}/sso`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->emails->ssoToRoundcube('website-id', 'user@example.com');
```

## updateDomainEmailAuth

Update email authentication preferences

`PUT /websites/{website_id}/domains/{domain_name}/email-auth`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainName` | `string` | yes |
| `$emailAuthUpdate` | `EmailAuthUpdate` | yes |

```php
use GoSuccess\Enhance\DTO\EmailAuthUpdate;

$emailAuthUpdate = new EmailAuthUpdate();
$emailAuthUpdate->dkim = true;

$result = $enhance->emails->updateDomainEmailAuth('website-id', 'example.com', $emailAuthUpdate);
```

## updateWebsiteEmail

Update website email

`PATCH /orgs/{org_id}/websites/{website_id}/emails/{email_address}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$emailAddress` | `string` | yes |
| `$updateEmail` | `UpdateEmail` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateEmail;

$updateEmail = new UpdateEmail();
$updateEmail->mailboxName = 'example';
$updateEmail->mailboxPassword = 's3cret';
$updateEmail->hasMailbox = true;
// ... set further properties as needed

$result = $enhance->emails->updateWebsiteEmail('website-id', 'user@example.com', $updateEmail);
```

## validateDomainEmailAuth

Validate email authentication DNS records

`GET /websites/{website_id}/domains/{domain_name}/email-auth/validate`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$domainName` | `string` | yes |

```php
$result = $enhance->emails->validateDomainEmailAuth('website-id', 'example.com');
```

