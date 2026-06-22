# GeneralResource

Accessed via `$enhance->general`.

| Method | Route |
| ------ | ----- |
| [`uploadWebsiteBackup`](#uploadwebsitebackup) | `POST /websites/{website_id}/backup/upload` |

## uploadWebsiteBackup

Upload and restore a .tar.gz archive

`POST /websites/{website_id}/backup/upload`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$contents` | `string` | yes |

```php
$result = $enhance->general->uploadWebsiteBackup('website-id', 'example');
```

