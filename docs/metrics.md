# MetricsResource

Accessed via `$enhance->metrics`.

| Method | Route |
| ------ | ----- |
| [`getWebsiteMetrics`](#getwebsitemetrics) | `GET /orgs/{org_id}/websites/{website_id}/metrics` |

## getWebsiteMetrics

Get website metrics

`GET /orgs/{org_id}/websites/{website_id}/metrics`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$websiteId` | `string` | yes |
| `$start` | `?string` | no |
| `$end` | `?string` | no |
| `$granularity` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->metrics->getWebsiteMetrics('website-id');
```

