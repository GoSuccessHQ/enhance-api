<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\Allowance;
use GoSuccess\Enhance\DTO\NewPlan;
use GoSuccess\Enhance\DTO\NewResourceId;
use GoSuccess\Enhance\DTO\Plan;
use GoSuccess\Enhance\DTO\PlansListing;
use GoSuccess\Enhance\DTO\Resource;
use GoSuccess\Enhance\DTO\Selection;
use GoSuccess\Enhance\DTO\UpdatePlan;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "plans" section of the Enhance API.
 */
final class PlansResource extends AbstractResource
{
    /**
     * Get plans
     *
     * Returns the organization's plans, optionally filtered by query parameters.
     * Note that the endpoint does not require authentication as anyone should be able to view an organization's plans on offer so that the viewer may decide to subscribe to a plan.
     *
     * @link https://apidocs.enhance.com/#/plans/getPlans
     * GET /orgs/{org_id}/plans
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return PlansListing|null
     */
    public function getPlans(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?string $orgId = null,
    ): ?PlansListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/plans", $query);

        return $response->decoded !== null ? PlansListing::fromArray($response->decoded) : null;
    }

    /**
     * Create plan
     *
     * Creates a new plan for organization.
     * If the organization is a reseller and not the MO, the reseller must itself have a subscription to a reseller plan. It is verified that the reseller is not trying to create a plan offering more resources than the reseller has available through its reseller plan.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/plans/createPlan
     * POST /orgs/{org_id}/plans
     *
     * @param NewPlan $newPlan New plan details
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceId|null
     */
    public function createPlan(NewPlan $newPlan, ?string $orgId = null): ?NewResourceId
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/plans", [], $newPlan);

        return $response->decoded !== null ? NewResourceId::fromArray($response->decoded) : null;
    }

    /**
     * Get plan
     *
     * Returns info on a single plan offered by this organization.
     * Note that the endpoint does not require authentication as anyone should be able to view an organization's plans on offer so that the viewer may decide to subscribe to a plan.
     *
     * @link https://apidocs.enhance.com/#/plans/getPlan
     * GET /orgs/{org_id}/plans/{plan_id}
     *
     * @param int $planId The id of the plan.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Plan|null
     */
    public function getPlan(?int $planId, ?string $orgId = null): ?Plan
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/plans/{$planId}");

        return $response->decoded !== null ? Plan::fromArray($response->decoded) : null;
    }

    /**
     * Update plan name
     *
     * Updates a plan's name of plan type
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/plans/updatePlan
     * PATCH /orgs/{org_id}/plans/{plan_id}
     *
     * @param int $planId The id of the plan.
     * @param UpdatePlan $updatePlan
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updatePlan(?int $planId, UpdatePlan $updatePlan, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/plans/{$planId}", [], $updatePlan);

        return $response->isSuccess;
    }

    /**
     * Delete plan
     *
     * Deletes a plan if no subscriptions exist to it.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/plans/deletePlan
     * DELETE /orgs/{org_id}/plans/{plan_id}
     *
     * @param int $planId The id of the plan.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deletePlan(?int $planId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/plans/{$planId}");

        return $response->isSuccess;
    }

    /**
     * Create plan resources
     *
     * Creates new resources for plan.
     * If the organization is a reseller and not the MO, it is verified that the reseller is not trying to update a plan to offer more of resource than the reseller has available through its reseller subscription.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/plans/createPlanResources
     * POST /orgs/{org_id}/plans/{plan_id}/resources
     *
     * @param int $planId The id of the plan.
     * @param array<int, mixed> $items
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createPlanResources(?int $planId, ?array $items, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/plans/{$planId}/resources", [], $items);

        return $response->isSuccess;
    }

    /**
     * Update plan resource
     *
     * Updates the plan resource.
     * If the organization is a reseller and not the MO, it is verified that the reseller is not trying to update a plan to offer more of resource than the reseller has available through its reseller subscription.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/plans/updatePlanResource
     * PUT /orgs/{org_id}/plans/{plan_id}/resources/{name}
     *
     * @param int $planId The id of the plan.
     * @param string $name The name of the resource.
     * @param resource $resource
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updatePlanResource(?int $planId, ?string $name, Resource $resource, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/plans/{$planId}/resources/{$name}", [], $resource);

        return $response->isSuccess;
    }

    /**
     * Create plan allowances
     *
     * Creates new allowances for plan.
     * If the organization is a reseller and not the MO, it is verified that the reseller is not trying to update a plan to offer allowances that the reseller doesn't have available in their reseller subscription.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/plans/createPlanAllowances
     * POST /orgs/{org_id}/plans/{plan_id}/allowances
     *
     * @param int $planId The id of the plan.
     * @param array<int, mixed> $items
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createPlanAllowances(?int $planId, ?array $items, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/plans/{$planId}/allowances", [], $items);

        return $response->isSuccess;
    }

    /**
     * Update plan allowance
     *
     * Updates the plan allowance.
     * If the organization is a reseller and not the MO, it is verified that the reseller is not trying to update a plan to offer more of allowance than the reseller has available through its reseller subscription.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/plans/updatePlanAllowance
     * PUT /orgs/{org_id}/plans/{plan_id}/allowances/{name}
     *
     * @param int $planId The id of the plan.
     * @param string $name The name of the allowance.
     * @param Allowance $allowance
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updatePlanAllowance(
        ?int $planId,
        ?string $name,
        Allowance $allowance,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/plans/{$planId}/allowances/{$name}", [], $allowance);

        return $response->isSuccess;
    }

    /**
     * Delete plan allowance
     *
     * Deletes the plan allowance.
     * Session holder must have admin privileges in this org or a parent. That is, to have Owner or SuperAdmin roles in the current org or a parent, or to have the Support role in a parent. org.
     *
     * @link https://apidocs.enhance.com/#/plans/deletePlanAllowance
     * DELETE /orgs/{org_id}/plans/{plan_id}/allowances/{name}
     *
     * @param int $planId The id of the plan.
     * @param string $name The name of the allowance.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deletePlanAllowance(?int $planId, ?string $name, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/plans/{$planId}/allowances/{$name}");

        return $response->isSuccess;
    }

    /**
     * Create plan selections
     *
     * Creates new selections for plan.
     * If the organization is a reseller and not the MO, it is verified that the reseller is not trying to update a plan to offer selections that the reseller doesn't have available in their reseller subscription.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/plans/createPlanSelections
     * POST /orgs/{org_id}/plans/{plan_id}/selections
     *
     * @param int $planId The id of the plan.
     * @param array<int, mixed> $items
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createPlanSelections(?int $planId, ?array $items, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/plans/{$planId}/selections", [], $items);

        return $response->isSuccess;
    }

    /**
     * Update plan selection
     *
     * Updates the plan selection.
     * If the organization is a reseller and not the MO, it is verified that the reseller is not trying to update a plan to offer more of selection than the reseller has available through its reseller subscription.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/plans/updatePlanSelection
     * PUT /orgs/{org_id}/plans/{plan_id}/selections/{name}
     *
     * @param int $planId The id of the plan.
     * @param string $name The name of the selection.
     * @param Selection $selection
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updatePlanSelection(
        ?int $planId,
        ?string $name,
        Selection $selection,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/plans/{$planId}/selections/{$name}", [], $selection);

        return $response->isSuccess;
    }
}
