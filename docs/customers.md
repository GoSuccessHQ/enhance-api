# CustomersResource

Accessed via `$enhance->customers`.

| Method | Route |
| ------ | ----- |
| [`createCustomer`](#createcustomer) | `POST /orgs/{org_id}/customers` |
| [`getOrgCustomers`](#getorgcustomers) | `GET /orgs/{org_id}/customers` |

## createCustomer

Create a customer organization

`POST /orgs/{org_id}/customers`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newCustomer` | `NewCustomer` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewCustomer;

$newCustomer = new NewCustomer();
$newCustomer->name = 'example';

$result = $enhance->customers->createCustomer($newCustomer);
```

## getOrgCustomers

Get organization customers

`GET /orgs/{org_id}/customers`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortBy` | `?string` | no |
| `$sortOrder` | `?string` | no |
| `$recursive` | `?bool` | no |
| `$maxDepth` | `?int` | no |
| `$status` | `?string` | no |
| `$planId` | `?int` | no |
| `$search` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->customers->getOrgCustomers();
```

