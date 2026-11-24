# ResourceUsageResource

Accessed via `$enhance->resourceUsage`.

| Method | Route |
| ------ | ----- |
| [`getWebsiteResourceUsage`](#getwebsiteresourceusage) | `GET /orgs/{org_id}/websites/{website_id}/resource_usage` |

## getWebsiteResourceUsage

Get website resource usage

`GET /orgs/{org_id}/websites/{website_id}/resource_usage`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$start` | `?string` | no |
| `$end` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->resourceUsage->getWebsiteResourceUsage('website-id');
```
