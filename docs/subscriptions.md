# SubscriptionsResource

Accessed via `$enhance->subscriptions`.

| Method | Route |
| ------ | ----- |
| [`calculateResourceUsage`](#calculateresourceusage) | `PUT /orgs/{org_id}/subscriptions/{subscription_id}/calculate-resource-usage` |
| [`createCustomerSubscription`](#createcustomersubscription) | `POST /orgs/{org_id}/customers/{customer_org_id}/subscriptions` |
| [`deleteSubscription`](#deletesubscription) | `DELETE /orgs/{org_id}/subscriptions/{subscription_id}` |
| [`getCustomerSubscriptions`](#getcustomersubscriptions) | `GET /orgs/{org_id}/customers/{customer_org_id}/subscriptions` |
| [`getSubscription`](#getsubscription) | `GET /orgs/{org_id}/subscriptions/{subscription_id}` |
| [`getSubscriptionBandwidthUsage`](#getsubscriptionbandwidthusage) | `GET /orgs/{org_id}/subscriptions/{subscription_id}/bandwidth` |
| [`getSubscriptionsToParent`](#getsubscriptionstoparent) | `GET /orgs/{org_id}/subscriptions` |
| [`updateSubscription`](#updatesubscription) | `PATCH /orgs/{org_id}/subscriptions/{subscription_id}` |

## calculateResourceUsage

Re-Calculates all subscription resources

`PUT /orgs/{org_id}/subscriptions/{subscription_id}/calculate-resource-usage`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$subscriptionId` | `float` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->subscriptions->calculateResourceUsage(1.0);
```

## createCustomerSubscription

Create a subscriptions for a customer

`POST /orgs/{org_id}/customers/{customer_org_id}/subscriptions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$customerOrgId` | `string` | yes |
| `$newSubscription` | `NewSubscription` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewSubscription;

$newSubscription = new NewSubscription();
$newSubscription->planId = 123;
$newSubscription->friendlyName = 'example';

$result = $enhance->subscriptions->createCustomerSubscription('customerOrg-id', $newSubscription);
```

## deleteSubscription

Delete subscription

`DELETE /orgs/{org_id}/subscriptions/{subscription_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$subscriptionId` | `float` | yes |
| `$force` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->subscriptions->deleteSubscription(1.0);
```

## getCustomerSubscriptions

Get customer subscriptions

`GET /orgs/{org_id}/customers/{customer_org_id}/subscriptions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$customerOrgId` | `string` | yes |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortBy` | `?string` | no |
| `$sortOrder` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->subscriptions->getCustomerSubscriptions('customerOrg-id');
```

## getSubscription

Get subscription

`GET /orgs/{org_id}/subscriptions/{subscription_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$subscriptionId` | `float` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->subscriptions->getSubscription(1.0);
```

## getSubscriptionBandwidthUsage

Get subscription bandwidth

`GET /orgs/{org_id}/subscriptions/{subscription_id}/bandwidth`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$subscriptionId` | `float` | yes |
| `$refreshCache` | `?bool` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->subscriptions->getSubscriptionBandwidthUsage(1.0);
```

## getSubscriptionsToParent

Get subscriptions to parent

`GET /orgs/{org_id}/subscriptions`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortBy` | `?string` | no |
| `$sortOrder` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->subscriptions->getSubscriptionsToParent();
```

## updateSubscription

Update subscription

`PATCH /orgs/{org_id}/subscriptions/{subscription_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$subscriptionId` | `float` | yes |
| `$updateSubscription` | `UpdateSubscription` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdateSubscription;
use GoSuccess\Enhance\Enum\Status;

$updateSubscription = new UpdateSubscription();
$updateSubscription->status = Status::Active;
$updateSubscription->isSuspended = true;
$updateSubscription->planId = 123;
// ... set further properties as needed

$result = $enhance->subscriptions->updateSubscription(1.0, $updateSubscription);
```

