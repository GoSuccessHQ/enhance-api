<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\NewResourceId;
use GoSuccess\Enhance\DTO\NewSubscription;
use GoSuccess\Enhance\DTO\Subscription;
use GoSuccess\Enhance\DTO\SubscriptionsListing;
use GoSuccess\Enhance\DTO\UpdateSubscription;
use GoSuccess\Enhance\DTO\UsedResourcesFullListing;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "subscriptions" section of the Enhance API.
 */
final class SubscriptionsResource extends AbstractResource
{
    /**
     * Get subscriptions to parent
     *
     * Lists subscriptions to the packages of the parent organization to which the currently selected organization is subscribed.
     *
     * @link https://apidocs.enhance.com/#/subscriptions/getSubscriptionsToParent
     * GET /orgs/{org_id}/subscriptions
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return SubscriptionsListing|null
     */
    public function getSubscriptionsToParent(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?string $orgId = null,
    ): ?SubscriptionsListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/subscriptions", $query);

        return $response->decoded !== null ? SubscriptionsListing::fromArray($response->decoded) : null;
    }

    /**
     * Get subscription bandwidth
     *
     * Queries the organization's subscription bandwidth for the current month. This includes all customer subscriptions if this subscription is a reseller.
     * By default the usage is cached for 12 hours unless `refreshCache` is `true`.
     * The value is in bytes.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/subscriptions/getSubscriptionBandwidthUsage
     * GET /orgs/{org_id}/subscriptions/{subscription_id}/bandwidth
     *
     * @param float $subscriptionId The id of the subscription.
     * @param bool|null $refreshCache If set to true, it will bypass internal caching.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return int|null
     */
    public function getSubscriptionBandwidthUsage(
        float $subscriptionId,
        ?bool $refreshCache = null,
        ?string $orgId = null,
    ): ?int {
        $orgId = $this->orgId($orgId);
        $query = [
            'refreshCache' => $refreshCache,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/subscriptions/{$subscriptionId}/bandwidth", $query);

        return $response->decoded === null ? null : (int)$response->decoded;
    }

    /**
     * Get subscription
     *
     * Queries the organization's subscription.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/subscriptions/getSubscription
     * GET /orgs/{org_id}/subscriptions/{subscription_id}
     *
     * @param float $subscriptionId The id of the subscription.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Subscription|null
     */
    public function getSubscription(float $subscriptionId, ?string $orgId = null): ?Subscription
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/subscriptions/{$subscriptionId}");

        return $response->decoded !== null ? Subscription::fromArray($response->decoded) : null;
    }

    /**
     * Update subscription
     *
     * Updates the organization's subscription.
     * This endpoint is used to update the subscription's status and suspension, by a parent organization admin.
     *
     * @link https://apidocs.enhance.com/#/subscriptions/updateSubscription
     * PATCH /orgs/{org_id}/subscriptions/{subscription_id}
     *
     * @param float $subscriptionId The id of the subscription.
     * @param UpdateSubscription $updateSubscription
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateSubscription(
        float $subscriptionId,
        UpdateSubscription $updateSubscription,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/subscriptions/{$subscriptionId}", [], $updateSubscription);

        return $response->isSuccess;
    }

    /**
     * Delete subscription
     *
     * Soft or force deletes the subscription and its resources.
     * All resources under the subscription (websites, customers in case of a reseller) will be deleted too.
     * If the subscription is soft-deleted (or marked as deleted), its data is not removed.  For removing all data and metadata, pass the `force=true` query parameter. This can only be done by a privileged MO member. In this case, all data is wiped, so use carefully.
     * If the `force` parameter is set, session holder must be an MO Owner, SuperAdmin, or Support member, otherwise it suffices for them to be such a member in a parent org.
     *
     * @link https://apidocs.enhance.com/#/subscriptions/deleteSubscription
     * DELETE /orgs/{org_id}/subscriptions/{subscription_id}
     *
     * @param float $subscriptionId The id of the subscription.
     * @param bool|null $force
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteSubscription(float $subscriptionId, ?bool $force = null, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $query = [
            'force' => $force,
        ];
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/subscriptions/{$subscriptionId}", $query);

        return $response->isSuccess;
    }

    /**
     * Re-Calculates all subscription resources
     *
     * Recursively Re-Calculates organization's subscription resources.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/subscriptions/calculateResourceUsage
     * PUT /orgs/{org_id}/subscriptions/{subscription_id}/calculate-resource-usage
     *
     * @param float $subscriptionId The id of the subscription.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return UsedResourcesFullListing|null
     */
    public function calculateResourceUsage(float $subscriptionId, ?string $orgId = null): ?UsedResourcesFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/subscriptions/{$subscriptionId}/calculate-resource-usage");

        return $response->decoded !== null ? UsedResourcesFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Get customer subscriptions
     *
     * Lists a customer's subscriptions to packages belonging to the selected organization.
     *
     * @link https://apidocs.enhance.com/#/subscriptions/getCustomerSubscriptions
     * GET /orgs/{org_id}/customers/{customer_org_id}/subscriptions
     *
     * @param string $customerOrgId The organization id of the organization's customer.
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return SubscriptionsListing|null
     */
    public function getCustomerSubscriptions(
        string $customerOrgId,
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?string $orgId = null,
    ): ?SubscriptionsListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/customers/{$customerOrgId}/subscriptions", $query);

        return $response->decoded !== null ? SubscriptionsListing::fromArray($response->decoded) : null;
    }

    /**
     * Create a subscriptions for a customer
     *
     * Creates a subscription for customer to the org's plan.
     * Only a reseller org or the MO may subscribe another org to one of its plans. If the organization is a reseller (and thus not the MO), it needs to have a suitable subscription to a reseller plan of its parent. It is verified that the reseller's reseller subscription has quota left to create the new subscription (because the new subscription draws from the reseller's reseller subscription).
     * After this call, the sold resources are recorded in the reseller subscription by increasing each sold resource's usage by the sold amount. In combination with the quota check, this is how it is ensured that the reseller doesn't sell more resources than it has paid for.
     * The MO may optionally override the package default servers or server group. All resources of this subscription will then be created on those servers. Otherwise the subscribed to plan's servers are used, or if those aren't defined either, the usual website placement rules are used every time a website is created under this subscription.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/subscriptions/createCustomerSubscription
     * POST /orgs/{org_id}/customers/{customer_org_id}/subscriptions
     *
     * @param string $customerOrgId The organization id of the organization's customer.
     * @param NewSubscription $newSubscription Subscription details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceId|null
     */
    public function createCustomerSubscription(
        string $customerOrgId,
        NewSubscription $newSubscription,
        ?string $orgId = null,
    ): ?NewResourceId {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/customers/{$customerOrgId}/subscriptions", [], $newSubscription);

        return $response->decoded !== null ? NewResourceId::fromArray($response->decoded) : null;
    }
}
