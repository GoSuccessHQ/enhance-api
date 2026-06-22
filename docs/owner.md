# OwnerResource

Accessed via `$enhance->owner`.

| Method | Route |
| ------ | ----- |
| [`deleteOwner`](#deleteowner) | `DELETE /orgs/{org_id}/owner` |
| [`updateOwner`](#updateowner) | `PUT /orgs/{org_id}/owner` |

## deleteOwner

Delete organization owner

`DELETE /orgs/{org_id}/owner`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->owner->deleteOwner();
```

## updateOwner

Update organization owner

`PUT /orgs/{org_id}/owner`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgOwnerUpdate` | `OrgOwnerUpdate` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\OrgOwnerUpdate;

$orgOwnerUpdate = new OrgOwnerUpdate();
$orgOwnerUpdate->memberId = 'member-id';

$result = $enhance->owner->updateOwner($orgOwnerUpdate);
```

