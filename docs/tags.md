# TagsResource

Accessed via `$enhance->tags`.

| Method | Route |
| ------ | ----- |
| [`createTag`](#createtag) | `POST /orgs/{org_id}/tags` |
| [`getTags`](#gettags) | `GET /orgs/{org_id}/tags` |

## createTag

Create tag

`POST /orgs/{org_id}/tags`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newTag` | `NewTag` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewTag;

$newTag = new NewTag();
$newTag->tag = 'example';
$newTag->colorCode = 'example';

$result = $enhance->tags->createTag($newTag);
```

## getTags

Get tags

`GET /orgs/{org_id}/tags`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$orgId` | `?string` | no |

```php
$result = $enhance->tags->getTags();
```

