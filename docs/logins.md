# LoginsResource

Accessed via `$enhance->logins`.

| Method | Route |
| ------ | ----- |
| [`createLogin`](#createlogin) | `POST /logins` |
| [`createOtpSession`](#createotpsession) | `GET /login/sessions/sso` |
| [`createSession`](#createsession) | `POST /login/sessions` |
| [`deleteCurrentSession`](#deletecurrentsession) | `DELETE /login/sessions/current` |
| [`deleteLoginAvatar`](#deleteloginavatar) | `DELETE /login/avatar` |
| [`deleteSession`](#deletesession) | `DELETE /login/sessions/{session_id}` |
| [`deleteSessions`](#deletesessions) | `DELETE /login/sessions` |
| [`finishPasswordRecovery`](#finishpasswordrecovery) | `POST /login/password-recovery` |
| [`getCustomerLogins`](#getcustomerlogins) | `GET /v2/orgs/{org_id}/customers/logins` |
| [`getLogin`](#getlogin) | `GET /login` |
| [`getLoginMemberships`](#getloginmemberships) | `GET /login/memberships` |
| [`getLogins`](#getlogins) | `GET /logins` |
| [`getOrgLogins`](#getorglogins) | `GET /orgs/{org_id}/logins` |
| [`getSessions`](#getsessions) | `GET /login/sessions` |
| [`getUiPreferences`](#getuipreferences) | `GET /logins/ui-preferences` |
| [`resendPin`](#resendpin) | `POST /login/2fa/resend-pin` |
| [`setCustomerLoginPassword`](#setcustomerloginpassword) | `PUT /v2/logins/{login_id}/password` |
| [`setLoginAvatar`](#setloginavatar) | `PUT /login/avatar` |
| [`setUiPreferences`](#setuipreferences) | `POST /logins/ui-preferences` |
| [`startPasswordRecovery`](#startpasswordrecovery) | `PUT /login/password-recovery` |
| [`updateLoginInfo`](#updatelogininfo) | `PATCH /login` |
| [`updateUiPreferences`](#updateuipreferences) | `PATCH /logins/ui-preferences` |
| [`validatePasswordRecovery`](#validatepasswordrecovery) | `POST /login/password-recovery/validate` |
| [`verify2FA`](#verify2fa) | `POST /login/2fa` |

## createLogin

Create a new login

`POST /logins`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$loginInfo` | `LoginInfo` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\LoginInfo;

$loginInfo = new LoginInfo();
$loginInfo->email = 'user@example.com';
$loginInfo->password = 's3cret';
$loginInfo->name = 'example';

$result = $enhance->logins->createLogin($loginInfo);
```

## createOtpSession

Create a new session for login with a one-time-password

`GET /login/sessions/sso`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$otp` | `?string` | no |

```php
$result = $enhance->logins->createOtpSession();
```

## createSession

Create a new session for login

`POST /login/sessions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$loginCreds` | `LoginCreds` | yes |
| `$realmId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\LoginCreds;

$loginCreds = new LoginCreds();
$loginCreds->email = 'user@example.com';
$loginCreds->password = 's3cret';
$loginCreds->deviceId = 'device-id';

$result = $enhance->logins->createSession($loginCreds);
```

## deleteCurrentSession

Delete current session

`DELETE /login/sessions/current`

```php
$result = $enhance->logins->deleteCurrentSession();
```

## deleteLoginAvatar

Remove login avatar

`DELETE /login/avatar`

```php
$result = $enhance->logins->deleteLoginAvatar();
```

## deleteSession

Delete current session

`DELETE /login/sessions/{session_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$sessionId` | `string` | yes |

```php
$result = $enhance->logins->deleteSession('session-id');
```

## deleteSessions

Delete sessions

`DELETE /login/sessions`

```php
$result = $enhance->logins->deleteSessions();
```

## finishPasswordRecovery

Finish a password recovery

`POST /login/password-recovery`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newPassword` | `NewPassword` | yes |
| `$secret` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewPassword;

$newPassword = new NewPassword();
$newPassword->newPassword = 's3cret';

$result = $enhance->logins->finishPasswordRecovery($newPassword);
```

## getCustomerLogins

List customer logins for org

`GET /v2/orgs/{org_id}/customers/logins`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortOrder` | `?string` | no |
| `$sortBy` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->logins->getCustomerLogins();
```

## getLogin

Get login info

`GET /login`

```php
$result = $enhance->logins->getLogin();
```

## getLoginMemberships

Get login memberships

`GET /login/memberships`

```php
$result = $enhance->logins->getLoginMemberships();
```

## getLogins

Query all logins

`GET /logins`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$realmId` | `?string` | no |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortOrder` | `?string` | no |
| `$sortBy` | `?string` | no |

```php
$result = $enhance->logins->getLogins();
```

## getOrgLogins

Query logins belonging to organization

`GET /orgs/{org_id}/logins`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortOrder` | `?string` | no |
| `$sortBy` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->logins->getOrgLogins();
```

## getSessions

Get all login sessions

`GET /login/sessions`

```php
$result = $enhance->logins->getSessions();
```

## getUiPreferences

Get UI prefereces for login

`GET /logins/ui-preferences`

```php
$result = $enhance->logins->getUiPreferences();
```

## resendPin

Resends 2FA sign-in code.

`POST /login/2fa/resend-pin`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$resendPin` | `ResendPin` | yes |

```php
use GoSuccess\Enhance\DTO\ResendPin;

$resendPin = new ResendPin();
$resendPin->authMethod = 'example';

$result = $enhance->logins->resendPin($resendPin);
```

## setCustomerLoginPassword

Set password for login

`PUT /v2/logins/{login_id}/password`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$loginId` | `string` | yes |
| `$newPassword` | `NewPassword` | yes |

```php
use GoSuccess\Enhance\DTO\NewPassword;

$newPassword = new NewPassword();
$newPassword->newPassword = 's3cret';

$result = $enhance->logins->setCustomerLoginPassword('login-id', $newPassword);
```

## setLoginAvatar

Set login avatar

`PUT /login/avatar`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$formData` | `?array` | no |

```php
$result = $enhance->logins->setLoginAvatar();
```

## setUiPreferences

Set new UI prefereces for login

`POST /logins/ui-preferences`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newUiPreferences` | `NewUiPreferences` | yes |

```php
use GoSuccess\Enhance\DTO\NewUiPreferences;
use GoSuccess\Enhance\Enum\UiPreferencesViewKind;

$newUiPreferences = new NewUiPreferences();
$newUiPreferences->fileManagerView = UiPreferencesViewKind::List;
$newUiPreferences->websiteView = UiPreferencesViewKind::List;
$newUiPreferences->spineOpen = true;
// ... set further properties as needed

$result = $enhance->logins->setUiPreferences($newUiPreferences);
```

## startPasswordRecovery

Start a new password recovery for login

`PUT /login/password-recovery`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$emailAddress` | `EmailAddress` | yes |
| `$realmId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\EmailAddress;

$emailAddress = new EmailAddress();
$emailAddress->email = 'user@example.com';

$result = $enhance->logins->startPasswordRecovery($emailAddress);
```

## updateLoginInfo

Update login info

`PATCH /login`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$updateLogin` | `UpdateLogin` | yes |

```php
use GoSuccess\Enhance\DTO\UpdateLogin;

$updateLogin = new UpdateLogin();
$updateLogin->name = 'example';
$updateLogin->email = 'user@example.com';
$updateLogin->password = 's3cret';
// ... set further properties as needed

$result = $enhance->logins->updateLoginInfo($updateLogin);
```

## updateUiPreferences

Update UI prefereces for login

`PATCH /logins/ui-preferences`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$updateUiPreferences` | `UpdateUiPreferences` | yes |

```php
use GoSuccess\Enhance\DTO\UpdateUiPreferences;
use GoSuccess\Enhance\Enum\UiPreferencesViewKind;

$updateUiPreferences = new UpdateUiPreferences();
$updateUiPreferences->fileManagerView = UiPreferencesViewKind::List;
$updateUiPreferences->websiteView = UiPreferencesViewKind::List;
$updateUiPreferences->spineOpen = true;
// ... set further properties as needed

$result = $enhance->logins->updateUiPreferences($updateUiPreferences);
```

## validatePasswordRecovery

Validate a password recovery secret

`POST /login/password-recovery/validate`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$secret` | `?string` | no |

```php
$result = $enhance->logins->validatePasswordRecovery();
```

## verify2FA

Verifies 2FA sign-in code.

`POST /login/2fa`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$login2FA` | `Login2FA` | yes |

```php
use GoSuccess\Enhance\DTO\Login2FA;

$login2FA = new Login2FA();
$login2FA->authMethod = 'example';
$login2FA->pin = 'example';

$result = $enhance->logins->verify2FA($login2FA);
```

