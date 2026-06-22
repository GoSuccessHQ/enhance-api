<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\Autoresponder;
use GoSuccess\Enhance\DTO\EmailAuth;
use GoSuccess\Enhance\DTO\EmailAuthUpdate;
use GoSuccess\Enhance\DTO\EmailAuthValidation;
use GoSuccess\Enhance\DTO\EmailDetailed;
use GoSuccess\Enhance\DTO\EmailsListing;
use GoSuccess\Enhance\DTO\LocalRemoteBody;
use GoSuccess\Enhance\DTO\NewAutoresponder;
use GoSuccess\Enhance\DTO\NewEmail;
use GoSuccess\Enhance\DTO\NewResourceId;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\SpamThresholds;
use GoSuccess\Enhance\DTO\UpdateEmail;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Enum\WebsiteStatus;

/**
 * Operations for the "emails" section of the Enhance API.
 */
final class EmailsResource extends AbstractResource
{
    /**
     * Get org emails
     *
     * Returns all emails belonging to this organization.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/emails/getEmails
     * GET /orgs/{org_id}/emails
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $search Limit the result set to the resources whose names, partially and case insensitively, match the specified search term. E.g. for websites, this is their domain or tag, for databases the database name, for emails the email address or mailbox name, etc. A website will also be returned if the search term exactly matches the website's uuid.
     * @param bool|null $recursive If set to true, the endpoint will return resources in some hierarchy recursively, that is, several or all levels of the hierarchy, depending on whether `maxDepth` is set. E.g. for customers this means direct and indirect customers are returned. For websites, this returns websites of all direct and indirect customers.
     * @param int|null $maxDepth If recursive is set to true, this can be specified to limit the recursion depth. By default there is no recursion bound.
     * @param WebsiteStatus|null $status Limit the result set to emails with the specified status. Only applicable if `recursive` is set to true.
     * @param string|null $domainId Limit the result set to emails under domain.
     * @param int|null $planId Limit the result set to resources under subscriptions to the plan.
     * @param int|null $subscriptionId Limit the result set to resources under subscription.
     * @param bool|null $includeInternal Include internal emails in response
     * @param bool|null $showDeleted Filters out deleted emails, which are otherwise returned in the result. Defaults to `showDeleted=true` if not set. Can only be set by MO, if set by others, a 403 is returned.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return EmailsListing|null
     */
    public function getEmails(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?string $search = null,
        ?bool $recursive = null,
        ?int $maxDepth = null,
        ?WebsiteStatus $status = null,
        ?string $domainId = null,
        ?int $planId = null,
        ?int $subscriptionId = null,
        ?bool $includeInternal = null,
        ?bool $showDeleted = null,
        ?string $orgId = null,
    ): ?EmailsListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'search' => $search,
            'recursive' => $recursive,
            'maxDepth' => $maxDepth,
            'status' => $status,
            'domainId' => $domainId,
            'planId' => $planId,
            'subscriptionId' => $subscriptionId,
            'includeInternal' => $includeInternal,
            'showDeleted' => $showDeleted,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/emails", $query);

        return $response->decoded !== null ? EmailsListing::fromArray($response->decoded) : null;
    }

    /**
     * Get email authentication preferences
     *
     * Fetch DKIM setting for the mailboxes on a given domain.
     *
     * @link https://apidocs.enhance.com/#/emails/getDomainEmailAuth
     * GET /websites/{website_id}/domains/{domain_name}/email-auth
     *
     * @param string $websiteId The id of the website.
     * @param string $domainName The full domain to query.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return EmailAuth|null
     */
    public function getDomainEmailAuth(string $websiteId, string $domainName): ?EmailAuth
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/domains/{$domainName}/email-auth");

        return $response->decoded !== null ? EmailAuth::fromArray($response->decoded) : null;
    }

    /**
     * Update email authentication preferences
     *
     * Update DKIM setting for the mailboxes on a given domain.
     *
     * @link https://apidocs.enhance.com/#/emails/updateDomainEmailAuth
     * PUT /websites/{website_id}/domains/{domain_name}/email-auth
     *
     * @param string $websiteId The id of the website.
     * @param string $domainName The full domain to query.
     * @param EmailAuthUpdate $emailAuthUpdate Email auth details.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateDomainEmailAuth(
        string $websiteId,
        string $domainName,
        EmailAuthUpdate $emailAuthUpdate,
    ): bool {
        $response = $this->client->request(HttpMethod::PUT, "/websites/{$websiteId}/domains/{$domainName}/email-auth", [], $emailAuthUpdate);

        return $response->isSuccess;
    }

    /**
     * Validate email authentication DNS records
     *
     * Validate DKIM and SPF.
     *
     * @link https://apidocs.enhance.com/#/emails/validateDomainEmailAuth
     * GET /websites/{website_id}/domains/{domain_name}/email-auth/validate
     *
     * @param string $websiteId The id of the website.
     * @param string $domainName The full domain to query.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return EmailAuthValidation|null
     */
    public function validateDomainEmailAuth(string $websiteId, string $domainName): ?EmailAuthValidation
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/domains/{$domainName}/email-auth/validate");

        return $response->decoded !== null ? EmailAuthValidation::fromArray($response->decoded) : null;
    }

    /**
     * Get the current local/remote status
     *
     * Fetches the current status of the domain, whether it is treated as local or remote by the MTA
     *
     * @link https://apidocs.enhance.com/#/emails/getDomainLocalRemote
     * GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/local_remote
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LocalRemoteBody|null
     */
    public function getDomainLocalRemote(string $websiteId, string $domainId, ?string $orgId = null): ?LocalRemoteBody
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/local_remote");

        return $response->decoded !== null ? LocalRemoteBody::fromArray($response->decoded) : null;
    }

    /**
     * Update email local/remote status
     *
     * Sets the MTA to treat this domain as either local or remote.
     *
     * @link https://apidocs.enhance.com/#/emails/setDomainLocalRemote
     * PUT /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/local_remote
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param LocalRemoteBody $localRemoteBody
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setDomainLocalRemote(
        string $websiteId,
        string $domainId,
        LocalRemoteBody $localRemoteBody,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/local_remote", [], $localRemoteBody);

        return $response->isSuccess;
    }

    /**
     * Get website emails
     *
     * Returns all emails belonging to a website.
     * The results may optionally be sorted and paginated.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/emails/getWebsiteEmails
     * GET /orgs/{org_id}/websites/{website_id}/emails
     *
     * @param string $websiteId The id of the website.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $search Limit the result set to the resources whose names, partially and case insensitively, match the specified search term. E.g. for websites, this is their domain or tag, for databases the database name, for emails the email address or mailbox name, etc. A website will also be returned if the search term exactly matches the website's uuid.
     * @param bool|null $includeInternal Include internal emails in response
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return EmailsListing|null
     */
    public function getWebsiteEmails(
        string $websiteId,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?string $search = null,
        ?bool $includeInternal = null,
        ?string $orgId = null,
    ): ?EmailsListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'search' => $search,
            'includeInternal' => $includeInternal,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/emails", $query);

        return $response->decoded !== null ? EmailsListing::fromArray($response->decoded) : null;
    }

    /**
     * Create an email under website's domain
     *
     * Creates a new email under the given website.
     * The email may have a mailbox or it may be a forwarder, which means it merely serves to forward incoming emails to the specified email addresses.
     * If a password is supplied, a mailbox is created. Otherwise, forwarders must be specified as an email must always have a delivery route.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/emails/createWebsiteEmail
     * POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/emails
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param NewEmail $newEmail New email details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createWebsiteEmail(
        string $websiteId,
        string $domainId,
        NewEmail $newEmail,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/emails", [], $newEmail);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Get website email
     *
     * Returns details about the given email belonging to the given website.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/emails/getWebsiteEmail
     * GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return EmailDetailed|null
     */
    public function getWebsiteEmail(string $websiteId, string $emailAddress, ?string $orgId = null): ?EmailDetailed
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/emails/{$emailAddress}");

        return $response->decoded !== null ? EmailDetailed::fromArray($response->decoded) : null;
    }

    /**
     * Update website email
     *
     * Updates the given email belonging to the given website.
     * The email may have a mailbox or it may be a forwarder, which means it merely serves to forward incoming emails to the specified email addresses.
     * If `hasMailbox` is set to false, the mailbox is deleted if it hadn't existed before, and vice versa. The email must either have a mailbox or forwarders an it must always have a delivery route.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/emails/updateWebsiteEmail
     * PATCH /orgs/{org_id}/websites/{website_id}/emails/{email_address}
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @param UpdateEmail $updateEmail Email update details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsiteEmail(
        string $websiteId,
        string $emailAddress,
        UpdateEmail $updateEmail,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/emails/{$emailAddress}", [], $updateEmail);

        return $response->isSuccess;
    }

    /**
     * Delete website email
     *
     * Deletes the email belonging to the given website.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/emails/deleteWebsiteEmail
     * DELETE /orgs/{org_id}/websites/{website_id}/emails/{email_address}
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteEmail(string $websiteId, string $emailAddress, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/emails/{$emailAddress}");

        return $response->isSuccess;
    }

    /**
     * Get website email client configuration
     *
     * Returns the client configuration for the given email.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/emails/getWebsiteEmailClientConf
     * GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}/client-conf
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function getWebsiteEmailClientConf(string $websiteId, string $emailAddress, ?string $orgId = null): mixed
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/emails/{$emailAddress}/client-conf");

        return $response->decoded;
    }

    /**
     * Get website email autoresponder
     *
     * Returns autoresponders configured for the given email.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/emails/getWebsiteEmailAutoresponder
     * GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}/autoresponder
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Autoresponder|null
     */
    public function getWebsiteEmailAutoresponder(
        string $websiteId,
        string $emailAddress,
        ?string $orgId = null,
    ): ?Autoresponder {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/emails/{$emailAddress}/autoresponder");

        return $response->decoded !== null ? Autoresponder::fromArray($response->decoded) : null;
    }

    /**
     * Create new website email autoresponder
     *
     * Creates a new autoresponder for the given email.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/emails/createWebsiteEmailAutoresponder
     * POST /orgs/{org_id}/websites/{website_id}/emails/{email_address}/autoresponder
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @param NewAutoresponder $newAutoresponder Autoresponder details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceId|null
     */
    public function createWebsiteEmailAutoresponder(
        string $websiteId,
        string $emailAddress,
        NewAutoresponder $newAutoresponder,
        ?string $orgId = null,
    ): ?NewResourceId {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/emails/{$emailAddress}/autoresponder", [], $newAutoresponder);

        return $response->decoded !== null ? NewResourceId::fromArray($response->decoded) : null;
    }

    /**
     * Delete website email autoresponder
     *
     * Deletes the autoresponder belonging to the given website email.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/emails/deleteWebsiteEmailAutoresponder
     * DELETE /orgs/{org_id}/websites/{website_id}/emails/{email_address}/autoresponder
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteEmailAutoresponder(
        string $websiteId,
        string $emailAddress,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/emails/{$emailAddress}/autoresponder");

        return $response->isSuccess;
    }

    /**
     * SSO to Roundcube
     *
     * Generate an SSO token for Roundcube and redirect the user
     *
     * @link https://apidocs.enhance.com/#/emails/ssoToRoundcube
     * GET /orgs/{org_id}/websites/{website_id}/emails/{email_address}/sso
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function ssoToRoundcube(string $websiteId, string $emailAddress, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/emails/{$emailAddress}/sso");

        return $response->isSuccess;
    }

    /**
     * Get spam thresholds for an email address
     *
     * @link https://apidocs.enhance.com/#/emails/getEmailSpamThresholds
     * GET /websites/{website_id}/emails/{email_address}/spam_thresholds
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return SpamThresholds|null
     */
    public function getEmailSpamThresholds(string $websiteId, string $emailAddress): ?SpamThresholds
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/emails/{$emailAddress}/spam_thresholds");

        return $response->decoded !== null ? SpamThresholds::fromArray($response->decoded) : null;
    }

    /**
     * Set spam thresholds for an email address
     *
     * @link https://apidocs.enhance.com/#/emails/setEmailSpamThresholds
     * PUT /websites/{website_id}/emails/{email_address}/spam_thresholds
     *
     * @param string $websiteId The id of the website.
     * @param string $emailAddress The address of the email.
     * @param SpamThresholds $spamThresholds Spam thresholds.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setEmailSpamThresholds(
        string $websiteId,
        string $emailAddress,
        SpamThresholds $spamThresholds,
    ): bool {
        $response = $this->client->request(HttpMethod::PUT, "/websites/{$websiteId}/emails/{$emailAddress}/spam_thresholds", [], $spamThresholds);

        return $response->isSuccess;
    }
}
