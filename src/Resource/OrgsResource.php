<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\ActivitiesListing;
use GoSuccess\Enhance\DTO\CloudFlareApiKey;
use GoSuccess\Enhance\DTO\NewCloudFlareToken;
use GoSuccess\Enhance\DTO\Org;
use GoSuccess\Enhance\DTO\OrgUpdate;
use GoSuccess\Enhance\DTO\ResourceCountByInterval;
use GoSuccess\Enhance\DTO\UpdateCloudFlareApiKey;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "orgs" section of the Enhance API.
 */
final class OrgsResource extends AbstractResource
{
    /**
     * Get organization info
     *
     * Returns basic organization information.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/orgs/getOrg
     * GET /orgs/{org_id}
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Org|null
     */
    public function getOrg(?string $orgId = null): ?Org
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}");

        return $response->decoded !== null ? Org::fromArray($response->decoded) : null;
    }

    /**
     * Update organization
     *
     * Updates the given org's name.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/orgs/updateOrg
     * PATCH /orgs/{org_id}
     *
     * @param OrgUpdate $orgUpdate Organization details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateOrg(OrgUpdate $orgUpdate, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}", [], $orgUpdate);

        return $response->isSuccess;
    }

    /**
     * Delete organization
     *
     * Soft or force deletes the organization and its resources.
     * All resources under the organization (websites, customers in case of a reseller) will be deleted too.
     * If the organization is soft-deleted (or marked as deleted), its data is not removed.  For removing all data and metadata, pass the `force=true` query parameter. This can only be done by a privileged MO member. In this case, all data is wiped, so use carefully.
     * If the `force` parameter is set, session holder must be an MO Owner, SuperAdmin, or Support member, otherwise it suffices for them to be such a member in a parent org.
     *
     * @link https://apidocs.enhance.com/#/orgs/deleteOrg
     * DELETE /orgs/{org_id}
     *
     * @param bool|null $force
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteOrg(?bool $force = null, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $query = [
            'force' => $force,
        ];
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}", $query);

        return $response->isSuccess;
    }

    /**
     * Set org avatar
     *
     * Sets the org's avatar, overwriting any previous one if one exists.
     * The max allowed size is 200 KiB. The image format may be jpeg, png, and ico.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/orgs/setOrgAvatar
     * PUT /orgs/{org_id}/avatar
     *
     * @param array<string, mixed> $formData Multipart form fields.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setOrgAvatar(?array $formData = null, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/avatar", [], $formData, 'multipart/form-data');

        return $response->isSuccess;
    }

    /**
     * Remove org avatar
     *
     * Deletes the org's avatar.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/orgs/deleteOrgAvatar
     * DELETE /orgs/{org_id}/avatar
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteOrgAvatar(?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/avatar");

        return $response->isSuccess;
    }

    /**
     * Get CloudFlare API keys, org level
     *
     * Returns the CloudFlare API keys for an org (obfuscated for security).
     *
     * @link https://apidocs.enhance.com/#/orgs/getCloudflareApiKeys
     * GET /orgs/{org_id}/cloudflare
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return CloudFlareApiKey[]
     */
    public function getCloudflareApiKeys(?string $orgId = null): array
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/cloudflare");

        return array_map(static fn (array $item): CloudFlareApiKey => CloudFlareApiKey::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Set CloudFlare API key, org level
     *
     * Adds a CloudFlare API key for an org.
     *
     * @link https://apidocs.enhance.com/#/orgs/createCloudflareApiKey
     * POST /orgs/{org_id}/cloudflare
     *
     * @param NewCloudFlareToken $newCloudFlareToken Key in plain text.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function createCloudflareApiKey(NewCloudFlareToken $newCloudFlareToken, ?string $orgId = null): ?string
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/cloudflare", [], $newCloudFlareToken);

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Get affected domains for a CloudFlare key
     *
     * Get affected domains for an organisation's CloudFlare key
     *
     * @link https://apidocs.enhance.com/#/orgs/getCloudFlareKeyAffectedDomains
     * GET /orgs/{org_id}/cloudflare/{cloudflare_key}
     *
     * @param string $cloudflareKey The id of a CloudFlare key to be acted upon.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function getCloudFlareKeyAffectedDomains(?string $cloudflareKey, ?string $orgId = null): array
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/cloudflare/{$cloudflareKey}");

        return (array)($response->decoded ?? []);
    }

    /**
     * Update CloudFlare API key
     *
     * Update a CloudFlare API key for an org.
     *
     * @link https://apidocs.enhance.com/#/orgs/updateCloudflareApiKey
     * PUT /orgs/{org_id}/cloudflare/{cloudflare_key}
     *
     * @param string $cloudflareKey The id of a CloudFlare key to be acted upon.
     * @param UpdateCloudFlareApiKey $updateCloudFlareApiKey Key in plain text.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateCloudflareApiKey(
        ?string $cloudflareKey,
        UpdateCloudFlareApiKey $updateCloudFlareApiKey,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/cloudflare/{$cloudflareKey}", [], $updateCloudFlareApiKey);

        return $response->isSuccess;
    }

    /**
     * Delete CloudFlare API key, org level
     *
     * Delete a CloudFlare API key for an org.
     *
     * @link https://apidocs.enhance.com/#/orgs/deleteCloudflareApiKey
     * DELETE /orgs/{org_id}/cloudflare/{cloudflare_key}
     *
     * @param string $cloudflareKey The id of a CloudFlare key to be acted upon.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteCloudflareApiKey(?string $cloudflareKey, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/cloudflare/{$cloudflareKey}");

        return $response->isSuccess;
    }

    /**
     * Get organization's activity log.
     *
     * Returns organization's activity log which is a human readable list of events that happened in orchd.
     * Only accessible to Owner, SuperAdmin and Sysadmin.
     *
     * @link https://apidocs.enhance.com/#/orgs/getOrgActivities
     * GET /v2/orgs/{org_id}/activities
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $createdBefore Only return resources which have been created earlier than provided date.
     * @param string|null $createdAfter Only return resources which have been created after provided date.
     * @param array<int, \GoSuccess\Enhance\Enum\ActivityKind>|null $activityKinds Select only activities matching the given kinds. If not provided or provided empty array, all kinds are selected as it makes no sense for an activity to not have a kind.
     * @param string[]|null $anyEntityId Filter activities maching any of the provided uuids. Since an activity can have 0 or more entities, providing an empty array is not the same as not providing this parameter. An empty array will match activities with 0 entities, while not providing this parameter will ignore this filter.
     * @param string|null $entityKind Activities which contain the given entity kind either as object or context entity.
     * @param string|null $search Limit the result set to the resources whose names, partially and case insensitively, match the specified search term. E.g. for websites, this is their domain or tag, for databases the database name, for emails the email address or mailbox name, etc. A website will also be returned if the search term exactly matches the website's uuid.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ActivitiesListing|null
     */
    public function getOrgActivities(
        ?int $offset = null,
        ?int $limit = null,
        ?string $createdBefore = null,
        ?string $createdAfter = null,
        ?array $activityKinds = null,
        ?array $anyEntityId = null,
        ?string $entityKind = null,
        ?string $search = null,
        ?string $orgId = null,
    ): ?ActivitiesListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'createdBefore' => $createdBefore,
            'createdAfter' => $createdAfter,
            'activityKinds' => $activityKinds,
            'anyEntityId' => $anyEntityId,
            'entityKind' => $entityKind,
            'search' => $search,
        ];
        $response = $this->client->request(HttpMethod::GET, "/v2/orgs/{$orgId}/activities", $query);

        return $response->decoded !== null ? ActivitiesListing::fromArray($response->decoded) : null;
    }

    /**
     * Get websites added over a given time period
     *
     * Returns the number of websites added each day over a given timeframe.
     *
     * @link https://apidocs.enhance.com/#/orgs/getWebsitesAdded
     * GET /orgs/{org_id}/stats/websites/added
     *
     * @param string|null $timeInterval
     * @param bool|null $recursion
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ResourceCountByInterval[]
     */
    public function getWebsitesAdded(
        ?string $timeInterval = null,
        ?bool $recursion = null,
        ?string $orgId = null,
    ): array {
        $orgId = $this->orgId($orgId);
        $query = [
            'timeInterval' => $timeInterval,
            'recursion' => $recursion,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/stats/websites/added", $query);

        return array_map(static fn (array $item): ResourceCountByInterval => ResourceCountByInterval::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Get customers added over a given time period
     *
     * Returns the number of customers added over a given time period. Includes only direct customers, not customers of customers.
     *
     * @link https://apidocs.enhance.com/#/orgs/getCustomersAdded
     * GET /orgs/{org_id}/stats/customers/added
     *
     * @param string|null $timeInterval
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ResourceCountByInterval[]
     */
    public function getCustomersAdded(?string $timeInterval = null, ?string $orgId = null): array
    {
        $orgId = $this->orgId($orgId);
        $query = [
            'timeInterval' => $timeInterval,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/stats/customers/added", $query);

        return array_map(static fn (array $item): ResourceCountByInterval => ResourceCountByInterval::fromArray($item), (array)($response->decoded ?? []));
    }
}
