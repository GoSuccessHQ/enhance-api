<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\LetsEncryptPreflightResult;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "letsencrypt" section of the Enhance API.
 */
final class LetsencryptResource extends AbstractResource
{
    /**
     * Generate and setup letsencrypt ssl certificates for website's domain
     *
     * Generates letsencrypt certificates for the domain.
     * This is a longer running task, that will do a complete ssl setup for a given domain. Once completed any given domain will get served over `https`.
     * Given domain must be publicly accessible and being served from our service.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/letsencrypt/createWebsiteDomainLetsencryptCerts
     * POST /v2/domains/{domain_id}/letsencrypt
     *
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createWebsiteDomainLetsencryptCerts(?string $domainId): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/v2/domains/{$domainId}/letsencrypt");

        return $response->isSuccess;
    }

    /**
     * Generate and setup letsencrypt ssl certificates for website's domain with mail. prefix.
     *
     * Generates letsencrypt certificate for the mail server at mail.customerdomain.
     *
     * @link https://apidocs.enhance.com/#/letsencrypt/createWebsiteMailDomainLetsencryptCerts
     * POST /v2/domains/{domain_id}/letsencrypt_mail
     *
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createWebsiteMailDomainLetsencryptCerts(?string $domainId): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/v2/domains/{$domainId}/letsencrypt_mail");

        return $response->isSuccess;
    }

    /**
     * Perform the LetsEncrypt preflight check
     *
     * Will attempt to verify that the domain will successfully achieve a LetsEncrypt certificate if attempted.  Provides debug information.
     *
     * @link https://apidocs.enhance.com/#/letsencrypt/performLetsEncryptPreflightCheck
     * POST /v2/domains/{domain_id}/letsencrypt_preflight
     *
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LetsEncryptPreflightResult|null
     */
    public function performLetsEncryptPreflightCheck(?string $domainId): ?LetsEncryptPreflightResult
    {
        $response = $this->client->request(HttpMethod::POST, "/v2/domains/{$domainId}/letsencrypt_preflight");

        return $response->decoded !== null ? LetsEncryptPreflightResult::fromArray($response->decoded) : null;
    }
}
