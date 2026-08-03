<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\CustomersListing;
use GoSuccess\Enhance\DTO\NewCustomer;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "customers" section of the Enhance API.
 */
final class CustomersResource extends AbstractResource
{
    /**
     * Get organization customers
     *
     * Returns the list of customers of a reseller organization.
     * If the recursive flag is set, the customers of reseller customers are returned as well recursively, up to an optional max depth value.
     * Note, for performance it is not checked whether org is a reseller. If it is not, an empty list is returned.
     *
     * @link https://apidocs.enhance.com/#/customers/getOrgCustomers
     * GET /orgs/{org_id}/customers
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param bool|null $recursive If set to true, the endpoint will return resources in some hierarchy recursively, that is, several or all levels of the hierarchy, depending on whether `maxDepth` is set. E.g. for customers this means direct and indirect customers are returned. For websites, this returns websites of all direct and indirect customers.
     * @param int|null $maxDepth If recursive is set to true, this can be specified to limit the recursion depth. By default there is no recursion bound.
     * @param string|null $status Filters the customers list by its status.
     * @param int|null $planId Limit the result set to resources under subscriptions to the plan.
     * @param string|null $search Limit the result set to the resources whose names, partially and case insensitively, match the specified search term. E.g. for websites, this is their domain or tag, for databases the database name, for emails the email address or mailbox name, etc. A website will also be returned if the search term exactly matches the website's uuid.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return CustomersListing|null
     */
    public function getOrgCustomers(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?bool $recursive = null,
        ?int $maxDepth = null,
        ?string $status = null,
        ?int $planId = null,
        ?string $search = null,
        ?string $orgId = null,
    ): ?CustomersListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'recursive' => $recursive,
            'maxDepth' => $maxDepth,
            'status' => $status,
            'planId' => $planId,
            'search' => $search,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/customers", $query);

        return \is_array($response->decoded) ? CustomersListing::fromArray($response->decoded) : null;
    }

    /**
     * Create a customer organization
     *
     * Once customer is successfully created under parent organization (identified by org_id), the customer organization's id is returned. This operation can only be done by a logged in superadmin or owner of the organization or its parent organization(s).
     *
     * @link https://apidocs.enhance.com/#/customers/createCustomer
     * POST /orgs/{org_id}/customers
     *
     * @param NewCustomer $newCustomer Customer organization details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createCustomer(NewCustomer $newCustomer, ?string $orgId = null): ?NewResourceUuid
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/customers", [], $newCustomer);

        return \is_array($response->decoded) ? NewResourceUuid::fromArray($response->decoded) : null;
    }
}
