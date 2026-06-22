# InvitesResource

Accessed via `$enhance->invites`.

| Method | Route |
| ------ | ----- |
| [`acceptInvite`](#acceptinvite) | `POST /invites/{invite_id}` |
| [`createInvite`](#createinvite) | `POST /orgs/{org_id}/invites` |
| [`validateInvite`](#validateinvite) | `POST /invites/{invite_id}/validate` |

## acceptInvite

Accept invite

`POST /invites/{invite_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$inviteId` | `string` | yes |
| `$acceptInviteBody` | `?AcceptInviteBody` | no |

```php
$result = $enhance->invites->acceptInvite('invite-id');
```

## createInvite

Create invite

`POST /orgs/{org_id}/invites`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newInvite` | `NewInvite` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewInvite;

$newInvite = new NewInvite();
$newInvite->email = 'user@example.com';
$newInvite->name = 'example';
$newInvite->sendEmail = true;

$result = $enhance->invites->createInvite($newInvite);
```

## validateInvite

Validate invite

`POST /invites/{invite_id}/validate`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$inviteId` | `string` | yes |

```php
$result = $enhance->invites->validateInvite('invite-id');
```

