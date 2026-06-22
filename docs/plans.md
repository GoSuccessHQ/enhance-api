# PlansResource

Accessed via `$enhance->plans`.

| Method | Route |
| ------ | ----- |
| [`createPlan`](#createplan) | `POST /orgs/{org_id}/plans` |
| [`createPlanAllowances`](#createplanallowances) | `POST /orgs/{org_id}/plans/{plan_id}/allowances` |
| [`createPlanResources`](#createplanresources) | `POST /orgs/{org_id}/plans/{plan_id}/resources` |
| [`createPlanSelections`](#createplanselections) | `POST /orgs/{org_id}/plans/{plan_id}/selections` |
| [`deletePlan`](#deleteplan) | `DELETE /orgs/{org_id}/plans/{plan_id}` |
| [`deletePlanAllowance`](#deleteplanallowance) | `DELETE /orgs/{org_id}/plans/{plan_id}/allowances/{name}` |
| [`getPlan`](#getplan) | `GET /orgs/{org_id}/plans/{plan_id}` |
| [`getPlans`](#getplans) | `GET /orgs/{org_id}/plans` |
| [`updatePlan`](#updateplan) | `PATCH /orgs/{org_id}/plans/{plan_id}` |
| [`updatePlanAllowance`](#updateplanallowance) | `PUT /orgs/{org_id}/plans/{plan_id}/allowances/{name}` |
| [`updatePlanResource`](#updateplanresource) | `PUT /orgs/{org_id}/plans/{plan_id}/resources/{name}` |
| [`updatePlanSelection`](#updateplanselection) | `PUT /orgs/{org_id}/plans/{plan_id}/selections/{name}` |

## createPlan

Create plan

`POST /orgs/{org_id}/plans`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$newPlan` | `NewPlan` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\NewPlan;

$newPlan = new NewPlan();
$newPlan->name = 'example';
$newPlan->serverGroupId = 'serverGroup-id';
$newPlan->allowServerGroupSelection = true;
// ... set further properties as needed

$result = $enhance->plans->createPlan($newPlan);
```

## createPlanAllowances

Create plan allowances

`POST /orgs/{org_id}/plans/{plan_id}/allowances`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$items` | `?array` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->plans->createPlanAllowances(123, []);
```

## createPlanResources

Create plan resources

`POST /orgs/{org_id}/plans/{plan_id}/resources`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$items` | `?array` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->plans->createPlanResources(123, []);
```

## createPlanSelections

Create plan selections

`POST /orgs/{org_id}/plans/{plan_id}/selections`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$items` | `?array` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->plans->createPlanSelections(123, []);
```

## deletePlan

Delete plan

`DELETE /orgs/{org_id}/plans/{plan_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->plans->deletePlan(123);
```

## deletePlanAllowance

Delete plan allowance

`DELETE /orgs/{org_id}/plans/{plan_id}/allowances/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$name` | `string` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->plans->deletePlanAllowance(123, 'example');
```

## getPlan

Get plan

`GET /orgs/{org_id}/plans/{plan_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$orgId` | `?string` | no |

```php
$result = $enhance->plans->getPlan(123);
```

## getPlans

Get plans

`GET /orgs/{org_id}/plans`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$offset` | `?int` | no |
| `$limit` | `?int` | no |
| `$sortBy` | `?string` | no |
| `$sortOrder` | `?string` | no |
| `$orgId` | `?string` | no |

```php
$result = $enhance->plans->getPlans();
```

## updatePlan

Update plan name

`PATCH /orgs/{org_id}/plans/{plan_id}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$updatePlan` | `UpdatePlan` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\UpdatePlan;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\PlanType;

$updatePlan = new UpdatePlan();
$updatePlan->name = 'example';
$updatePlan->planType = PlanType::Shared;
$updatePlan->defaultPhpVersion = PhpVersion::Php56;
// ... set further properties as needed

$result = $enhance->plans->updatePlan(123, $updatePlan);
```

## updatePlanAllowance

Update plan allowance

`PUT /orgs/{org_id}/plans/{plan_id}/allowances/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$name` | `string` | yes |
| `$allowance` | `Allowance` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\Allowance;

$allowance = new Allowance();
$allowance->name = 'example';

$result = $enhance->plans->updatePlanAllowance(123, 'example', $allowance);
```

## updatePlanResource

Update plan resource

`PUT /orgs/{org_id}/plans/{plan_id}/resources/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$name` | `string` | yes |
| `$resource` | `Resource` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\Resource;
use GoSuccess\Enhance\Enum\ResourceName;

$resource = new Resource();
$resource->name = ResourceName::Customers;
$resource->total = 10;

$result = $enhance->plans->updatePlanResource(123, 'example', $resource);
```

## updatePlanSelection

Update plan selection

`PUT /orgs/{org_id}/plans/{plan_id}/selections/{name}`

| Parameter | Type | Required |
| --------- | ---- | -------- |
| `$planId` | `int` | yes |
| `$name` | `string` | yes |
| `$selection` | `Selection` | yes |
| `$orgId` | `?string` | no |

```php
use GoSuccess\Enhance\DTO\Selection;

$selection = new Selection();
$selection->name = 'example';
$selection->value = 'example';

$result = $enhance->plans->updatePlanSelection(123, 'example', $selection);
```

