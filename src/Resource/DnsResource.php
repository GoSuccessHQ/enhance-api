<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\DefaultDnsRecord;
use GoSuccess\Enhance\DTO\DnsThirdPartyProvider;
use GoSuccess\Enhance\DTO\DnsZone;
use GoSuccess\Enhance\DTO\NewDefaultDnsRecord;
use GoSuccess\Enhance\DTO\NewDnsRecord;
use GoSuccess\Enhance\DTO\NewDnsThirdPartyProvider;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\UpdateDefaultDnsRecord;
use GoSuccess\Enhance\DTO\UpdateDnsRecord;
use GoSuccess\Enhance\DTO\UpdateDnsZone;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "dns" section of the Enhance API.
 */
final class DnsResource extends AbstractResource
{
    /**
     * List default DNS records
     *
     * Lists the DNS records which will be added to all newly created DNS zones.
     *
     * @link https://apidocs.enhance.com/#/dns/listDefaultDnsRecords
     * GET /v2/settings/dns/default-records
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DefaultDnsRecord[]
     */
    public function listDefaultDnsRecords(): array
    {
        $response = $this->client->request(HttpMethod::GET, '/v2/settings/dns/default-records');

        return array_map(static fn (array $item): DefaultDnsRecord => DefaultDnsRecord::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Create a default DNS record
     *
     * Creates a default record at a platform level which will be added to all newly created DNS zones.  In the value you can use $$origin$$ which will be substituted for the origin domain.
     *
     * @link https://apidocs.enhance.com/#/dns/createDefaultDnsRecord
     * POST /v2/settings/dns/default-records
     *
     * @param NewDefaultDnsRecord $newDefaultDnsRecord
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function createDefaultDnsRecord(NewDefaultDnsRecord $newDefaultDnsRecord): ?string
    {
        $response = $this->client->request(HttpMethod::POST, '/v2/settings/dns/default-records', [], $newDefaultDnsRecord);

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Update a default DNS record
     *
     * Updates a default DNS record, all fields are optional.
     *
     * @link https://apidocs.enhance.com/#/dns/updateDefaultDnsRecord
     * PATCH /v2/settings/dns/default-records/{record_id}
     *
     * @param string $recordId
     * @param UpdateDefaultDnsRecord $updateDefaultDnsRecord
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateDefaultDnsRecord(string $recordId, UpdateDefaultDnsRecord $updateDefaultDnsRecord): bool
    {
        $response = $this->client->request(HttpMethod::PATCH, "/v2/settings/dns/default-records/{$recordId}", [], $updateDefaultDnsRecord);

        return $response->isSuccess;
    }

    /**
     * Delete a default DNS record
     *
     * Delete a default DNS record.  Will not remove from existing zones.
     *
     * @link https://apidocs.enhance.com/#/dns/deleteDefaultDnsRecord
     * DELETE /v2/settings/dns/default-records/{record_id}
     *
     * @param string $recordId
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteDefaultDnsRecord(string $recordId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/v2/settings/dns/default-records/{$recordId}");

        return $response->isSuccess;
    }

    /**
     * Get a dns zone for given domain
     *
     * Returns details about the dns zone of given domain. Returns Soa record and all other records.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/dns/getWebsiteDomainDnsZone
     * GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DnsZone|null
     */
    public function getWebsiteDomainDnsZone(string $websiteId, string $domainId, ?string $orgId = null): ?DnsZone
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/dns-zone");

        return \is_array($response->decoded) ? DnsZone::fromArray($response->decoded) : null;
    }

    /**
     * Updates a dns zone SOA for website domain
     *
     * Partially updates dns zone SOA record for existing zone.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/dns/updateWebsiteDomainDnsZone
     * PATCH /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param UpdateDnsZone $updateDnsZone Fields to update.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsiteDomainDnsZone(
        string $websiteId,
        string $domainId,
        UpdateDnsZone $updateDnsZone,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/dns-zone", [], $updateDnsZone);

        return $response->isSuccess;
    }

    /**
     * Create a new dns record for website domain
     *
     * Creates a new dns record for a website's domain dns zone.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/dns/createWebsiteDomainDnsZoneRecord
     * POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/records
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param NewDnsRecord $newDnsRecord New dns record details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createWebsiteDomainDnsZoneRecord(
        string $websiteId,
        string $domainId,
        NewDnsRecord $newDnsRecord,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/dns-zone/records", [], $newDnsRecord);

        return \is_array($response->decoded) ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Updates a dns record for given domain
     *
     * Partially updates a dns record for existing zone.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/dns/updateWebsiteDomainDnsZoneRecord
     * PATCH /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/records/{record_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string $recordId The id of the record.
     * @param UpdateDnsRecord $updateDnsRecord Fields to update.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsiteDomainDnsZoneRecord(
        string $websiteId,
        string $domainId,
        string $recordId,
        UpdateDnsRecord $updateDnsRecord,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/dns-zone/records/{$recordId}", [], $updateDnsRecord);

        return $response->isSuccess;
    }

    /**
     * Delete dns zone record
     *
     * Deletes a dns zone record for given domain.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/dns/deleteWebsiteDomainDnsZoneRecord
     * DELETE /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/records/{record_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string $recordId The id of the record.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteDomainDnsZoneRecord(
        string $websiteId,
        string $domainId,
        string $recordId,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/dns-zone/records/{$recordId}");

        return $response->isSuccess;
    }

    /**
     * Enable DNSSEC on this domain
     *
     * Will enable DNSSEC and return the relevant DS records
     *
     * @link https://apidocs.enhance.com/#/dns/enableDomainDnsSec
     * POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/dnssec
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function enableDomainDnsSec(string $websiteId, string $domainId, ?string $orgId = null): ?string
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/dns-zone/dnssec");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Disable DNSSEC on this domain
     *
     * Will disable DNSSEC on this domain.  The DS records must be removed from the upstream DNS provider first to avoid downtime.
     *
     * @link https://apidocs.enhance.com/#/dns/disableDomainDnsSec
     * DELETE /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-zone/dnssec
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function disableDomainDnsSec(string $websiteId, string $domainId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/dns-zone/dnssec");

        return $response->isSuccess;
    }

    /**
     * Lists all third party providers.
     *
     * This operation can only be done by an MO admin.
     * Third party providers are notified about changes to dns zones within Enhance. This endpoint lists all registered URLs which listen to these changes.
     *
     * @link https://apidocs.enhance.com/#/dns/getDnsThirdPartyProviders
     * GET /dns/third-party-providers
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DnsThirdPartyProvider[]
     */
    public function getDnsThirdPartyProviders(): array
    {
        $response = $this->client->request(HttpMethod::GET, '/dns/third-party-providers');

        return array_map(static fn (array $item): DnsThirdPartyProvider => DnsThirdPartyProvider::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Create new third party provider.
     *
     * This operation can only be done by an MO admin.
     * Third party providers are notified about changes to dns zones within Enhance. This endpoint creates a new provider which is going to be notified on provided URL about dns updates.
     * Please not that after adding a new provider using this endpoint, the provider will initially receive a request to delete all its current data and then Enhance will send a request with all existing dns zones.
     *
     * @link https://apidocs.enhance.com/#/dns/createDnsThirdPartyProvider
     * POST /dns/third-party-providers
     *
     * @param NewDnsThirdPartyProvider $newDnsThirdPartyProvider Url where the updates are sent and map of header names to their values.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createDnsThirdPartyProvider(NewDnsThirdPartyProvider $newDnsThirdPartyProvider): bool
    {
        $response = $this->client->request(HttpMethod::POST, '/dns/third-party-providers', [], $newDnsThirdPartyProvider);

        return $response->isSuccess;
    }

    /**
     * Deletes a third party dns provider.
     *
     * This operation can only be done by an MO admin.
     * Third party providers are notified about changes to dns zones within Enhance. This endpoint removes an existing provider. After this endpoint resolves, no new dns zones are going to be replicated to the provider.
     *
     * @link https://apidocs.enhance.com/#/dns/deleteDnsThirdPartyProvider
     * DELETE /dns/third-party-providers/{provider_id}
     *
     * @param int $providerId The id of the third party provider which can be obtained by querying the GET /dns/third-party-providers endpoint.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteDnsThirdPartyProvider(int $providerId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/dns/third-party-providers/{$providerId}");

        return $response->isSuccess;
    }
}
