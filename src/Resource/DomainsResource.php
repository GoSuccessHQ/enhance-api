<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\AuthNsResponse;
use GoSuccess\Enhance\DTO\CloudFlareApiKey;
use GoSuccess\Enhance\DTO\CloudFlareNameServers;
use GoSuccess\Enhance\DTO\DomainInUseStatus;
use GoSuccess\Enhance\DTO\DomainsListing;
use GoSuccess\Enhance\DTO\ModSecStatus;
use GoSuccess\Enhance\DTO\NewDomain;
use GoSuccess\Enhance\DTO\Vhost;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "domains" section of the Enhance API.
 */
final class DomainsResource extends AbstractResource
{
    /**
     * Get domains
     *
     * Lists the domains belonging to this organization.
     *
     * @link https://apidocs.enhance.com/#/domains/getDomains
     * GET /orgs/{org_id}/domains
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DomainsListing|null
     */
    public function getDomains(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?string $orgId = null,
    ): ?DomainsListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/domains", $query);

        return \is_array($response->decoded) ? DomainsListing::fromArray($response->decoded) : null;
    }

    /**
     * Delete domain
     *
     * Deletes a domain. Only privileged org members or parent org admins may do this.
     *
     * @link https://apidocs.enhance.com/#/domains/deleteDomain
     * DELETE /orgs/{org_id}/domains/{domain_id}
     *
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteDomain(string $domainId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/domains/{$domainId}");

        return $response->isSuccess;
    }

    /**
     * Get authoritative nameservers for domain.
     *
     * Get authoritative nameservers for domain and check if they match known DNS IPs of the Enhance cluster
     *
     * @link https://apidocs.enhance.com/#/domains/getDomainAuthNs
     * GET /orgs/{org_id}/domains/{domain_id}/auth-ns
     *
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return AuthNsResponse|null
     */
    public function getDomainAuthNs(string $domainId, ?string $orgId = null): ?AuthNsResponse
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/domains/{$domainId}/auth-ns");

        return \is_array($response->decoded) ? AuthNsResponse::fromArray($response->decoded) : null;
    }

    /**
     * Get CloudFlare API key, domain level
     *
     * Returns the CloudFlare API key for a domain (obfuscated for security). This key will override an org level key.
     *
     * @link https://apidocs.enhance.com/#/domains/getCloudflareApiKeyDomain
     * GET /orgs/{org_id}/domains/{domain_id}/cloudflare
     *
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return CloudFlareApiKey|null
     */
    public function getCloudflareApiKeyDomain(string $domainId, ?string $orgId = null): ?CloudFlareApiKey
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/domains/{$domainId}/cloudflare");

        return \is_array($response->decoded) ? CloudFlareApiKey::fromArray($response->decoded) : null;
    }

    /**
     * Set CloudFlare API key, domain level
     *
     * Sets the CloudFlare API key for a domain.  This key will override an org level key.
     *
     * @link https://apidocs.enhance.com/#/domains/setCloudflareApiKeyId
     * PUT /orgs/{org_id}/domains/{domain_id}/cloudflare
     *
     * @param string $domainId The id of the domain.
     * @param string $value Cloudflare API key ID.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setCloudflareApiKeyId(string $domainId, ?string $value, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/domains/{$domainId}/cloudflare", [], $value);

        return $response->isSuccess;
    }

    /**
     * Delete CloudFlare API key, domain level
     *
     * Deletes the CloudFlare API key for a domain
     *
     * @link https://apidocs.enhance.com/#/domains/deleteCloudflareApiKeyId
     * DELETE /orgs/{org_id}/domains/{domain_id}/cloudflare
     *
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteCloudflareApiKeyId(string $domainId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/domains/{$domainId}/cloudflare");

        return $response->isSuccess;
    }

    /**
     * Get CloudFlare name servers
     *
     * Returns the CloudFlare nameservers for a given domain, if it exists in CloudFlare.
     *
     * @link https://apidocs.enhance.com/#/domains/getCloudflareNameServers
     * GET /orgs/{org_id}/domains/{domain_id}/cloudflare/nameservers
     *
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return CloudFlareNameServers|null
     */
    public function getCloudflareNameServers(string $domainId, ?string $orgId = null): ?CloudFlareNameServers
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/domains/{$domainId}/cloudflare/nameservers");

        return \is_array($response->decoded) ? CloudFlareNameServers::fromArray($response->decoded) : null;
    }

    /**
     * Check if a domain can be created
     *
     * An organisation can perform a pre-flight check to see if a domain can be added.  This is useful for form validation.  It will return a status indicating if the domain is in use and, if so, whether it is on the current organisation or another.  If it is in use on the current organisation we will also return the websiteId the domain belongs to.
     *
     * @link https://apidocs.enhance.com/#/domains/checkDomain
     * POST /orgs/{org_id}/domains/check
     *
     * @param NewDomain $newDomain Domain details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DomainInUseStatus|null
     */
    public function checkDomain(NewDomain $newDomain, ?string $orgId = null): ?DomainInUseStatus
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/domains/check", [], $newDomain);

        return \is_array($response->decoded) ? DomainInUseStatus::fromArray($response->decoded) : null;
    }

    /**
     * Get mod security status for a single domain
     *
     * @link https://apidocs.enhance.com/#/domains/getWebsiteDomainModSecStatus
     * GET /v2/domains/{domain_id}/modsec_status
     *
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ModSecStatus|null
     */
    public function getWebsiteDomainModSecStatus(string $domainId): ?ModSecStatus
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/domains/{$domainId}/modsec_status");

        return \is_array($response->decoded) ? ModSecStatus::fromArray($response->decoded) : null;
    }

    /**
     * Set mod security status on a single domain
     *
     * @link https://apidocs.enhance.com/#/domains/setWebsiteDomainModSecStatus
     * PUT /v2/domains/{domain_id}/modsec_status
     *
     * @param string $domainId The id of the domain.
     * @param ModSecStatus $modSecStatus
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteDomainModSecStatus(string $domainId, ModSecStatus $modSecStatus): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/domains/{$domainId}/modsec_status", [], $modSecStatus);

        return $response->isSuccess;
    }

    /**
     * Get domain's custom vhost file, if the file does not exist return empty string
     *
     * @link https://apidocs.enhance.com/#/domains/getWebsiteDomainVhost
     * GET /v2/domains/{domain_id}/vhost
     *
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Vhost|null
     */
    public function getWebsiteDomainVhost(string $domainId): ?Vhost
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/domains/{$domainId}/vhost");

        return \is_array($response->decoded) ? Vhost::fromArray($response->decoded) : null;
    }

    /**
     * Set a custom vhost file
     *
     * @link https://apidocs.enhance.com/#/domains/setWebsiteDomainVhost
     * PUT /v2/domains/{domain_id}/vhost
     *
     * @param string $domainId The id of the domain.
     * @param Vhost $vhost
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteDomainVhost(string $domainId, Vhost $vhost): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/domains/{$domainId}/vhost", [], $vhost);

        return $response->isSuccess;
    }

    /**
     * Deletes domain's custom vhost file if any
     *
     * @link https://apidocs.enhance.com/#/domains/deleteWebsiteDomainVhost
     * DELETE /v2/domains/{domain_id}/vhost
     *
     * @param string $domainId The id of the domain.
     * @param mixed $body
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteDomainVhost(string $domainId, mixed $body): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/v2/domains/{$domainId}/vhost", [], $body);

        return $response->isSuccess;
    }
}
