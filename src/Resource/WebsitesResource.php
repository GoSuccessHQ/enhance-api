<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\BackupStatus;
use GoSuccess\Enhance\DTO\CgroupLimits;
use GoSuccess\Enhance\DTO\ContainerIpInfo;
use GoSuccess\Enhance\DTO\CrontabFullListing;
use GoSuccess\Enhance\DTO\DnsQueryOutcome;
use GoSuccess\Enhance\DTO\DomainMapping;
use GoSuccess\Enhance\DTO\DomainMappingsFullListing;
use GoSuccess\Enhance\DTO\DomainMappingUpdate;
use GoSuccess\Enhance\DTO\FsQuotaInfo;
use GoSuccess\Enhance\DTO\FsQuotaLimit;
use GoSuccess\Enhance\DTO\LsphpSettings;
use GoSuccess\Enhance\DTO\NewMappedDomain;
use GoSuccess\Enhance\DTO\NewPassword;
use GoSuccess\Enhance\DTO\NewPrimaryDomainMapping;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\NewSshKey;
use GoSuccess\Enhance\DTO\NewSshKeyId;
use GoSuccess\Enhance\DTO\NewWebsite;
use GoSuccess\Enhance\DTO\RequireIpsRule;
use GoSuccess\Enhance\DTO\RewriteChainFullListing;
use GoSuccess\Enhance\DTO\SetCgroupLimits;
use GoSuccess\Enhance\DTO\SshKeyFullListing;
use GoSuccess\Enhance\DTO\SshKeyUpdate;
use GoSuccess\Enhance\DTO\UnixTimestamp;
use GoSuccess\Enhance\DTO\UpdateCrontabFullListing;
use GoSuccess\Enhance\DTO\UpdateRewriteChainFullListing;
use GoSuccess\Enhance\DTO\UpdateWebsite;
use GoSuccess\Enhance\DTO\UuidListing;
use GoSuccess\Enhance\DTO\ValidationResult;
use GoSuccess\Enhance\DTO\WebServerRewrite;
use GoSuccess\Enhance\DTO\Website;
use GoSuccess\Enhance\DTO\WebsiteCloneFullListing;
use GoSuccess\Enhance\DTO\WebsiteCloneLogEntry;
use GoSuccess\Enhance\DTO\WebsiteCloneRequest;
use GoSuccess\Enhance\DTO\WebsiteCloneResponse;
use GoSuccess\Enhance\DTO\WebsiteOperationValidation;
use GoSuccess\Enhance\DTO\WebsiteServerDomains;
use GoSuccess\Enhance\DTO\WebsitesListing;
use GoSuccess\Enhance\Enum\DnsStatus;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Enum\Recursion;
use GoSuccess\Enhance\Enum\SettingKind;
use GoSuccess\Enhance\Enum\WebserverKind;
use GoSuccess\Enhance\Enum\WebsiteKind;
use GoSuccess\Enhance\Enum\WebsiteStatus;

/**
 * Operations for the "websites" section of the Enhance API.
 */
final class WebsitesResource extends AbstractResource
{
    /**
     * Get websites
     *
     * Returns all websites belonging to the organization.
     * The results may optionally be sorted and paginated. If the recursive flag is set, the websites of customers of reseller customers are returned as well recursively, up to an optional max depth value.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or must have access to at least one website in this org. If the member is not an admin but has access to one or more websites, only those websites are returned.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsites
     * GET /orgs/{org_id}/websites
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $search Limit the result set to the resources whose names, partially and case insensitively, match the specified search term. E.g. for websites, this is their domain or tag, for databases the database name, for emails the email address or mailbox name, etc. A website will also be returned if the search term exactly matches the website's uuid.
     * @param Recursion|null $recursion If set to directCustomers then websites belonging to direct customers of the orgId will be returned. If set to infinite then websites belonging to customers of customers (and so on) will be returned. If unset then no recursion will be performed.
     * @param int|null $planId Limit the result set to resources under subscriptions to the plan.
     * @param int|null $subscriptionId Limit the result set to resources under subscription.
     * @param WebsiteStatus|null $status Limit the result set to websites with the specified status. Only applicable if `recursive` is set to true.
     * @param bool|null $isSuspended Limit the result set to websites which are currently suspended or not suspended.
     * @param array<int, \GoSuccess\Enhance\Enum\ServerRole>|null $roles Limit the result set to websites having one of these roles assigned to a server.
     * @param string[]|null $servers Limit the result set to websites having one of the selected roles (or all roles) on one of these servers.
     * @param WebsiteKind|null $kind Limit the results to websites of the specified type.
     * @param bool|null $showDeleted Filters out deleted websites, which are otherwise returned in the result. Defaults to `showDeleted=true` if not set. Can only be set by MO, if set by others, a 403 is returned.
     * @param bool|null $showAliases Includes domain aliases in search results and listings in addition to the website's primary domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsitesListing|null
     */
    public function getWebsites(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?string $search = null,
        ?Recursion $recursion = null,
        ?int $planId = null,
        ?int $subscriptionId = null,
        ?WebsiteStatus $status = null,
        ?bool $isSuspended = null,
        ?array $roles = null,
        ?array $servers = null,
        ?WebsiteKind $kind = null,
        ?bool $showDeleted = null,
        ?bool $showAliases = null,
        ?string $orgId = null,
    ): ?WebsitesListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'search' => $search,
            'recursion' => $recursion,
            'planId' => $planId,
            'subscriptionId' => $subscriptionId,
            'status' => $status,
            'isSuspended' => $isSuspended,
            'roles' => $roles,
            'servers' => $servers,
            'kind' => $kind,
            'showDeleted' => $showDeleted,
            'showAliases' => $showAliases,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites", $query);

        return $response->decoded !== null ? WebsitesListing::fromArray($response->decoded) : null;
    }

    /**
     * Create a new website or clone an existing one.
     *
     * Creates or clone a website under the organization.
     * If the org is the MO, the request need not contain a subscription ID, but if it's a customer and the session holder is not an MO admin, the subscription to which to attach the website must be supplied.
     * If the website to be created is 'staging' kind then the subscription must include stagingWebsites resource > 1.  If 'normal' then the subscription must include websites > 1.
     * If the website to be created is a control panel, the reseller's subscription id must match the reseller subscription.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/websites/createWebsite
     * POST /orgs/{org_id}/websites
     *
     * @param NewWebsite $newWebsite New website details. If the organization is the MO, they need not have a subscription to create a website. In all other cases organization needs to be subscribed to a plan that allows creating websites.
     * @param WebsiteKind|null $kind The kind of a *special* website that needs to be created. Whether this website is to be a *control panel* website or a *phpMyAdmin* website. Note: in order to create a new *phpMyAdmin* website the control panel website needs to be created first, since the new phpMyAdmin website will be under the control panel domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createWebsite(
        NewWebsite $newWebsite,
        ?WebsiteKind $kind = null,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $query = [
            'kind' => $kind,
        ];
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites", $query, $newWebsite);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Delete websites
     *
     * This operation can only be done by a logged in superadmin or owner of the organization or its parent organization(s).
     *
     * @link https://apidocs.enhance.com/#/websites/deleteWebsites
     * DELETE /orgs/{org_id}/websites
     *
     * @param UuidListing $uuidListing The ids of the websites to delete.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsites(UuidListing $uuidListing, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites", [], $uuidListing);

        return $response->isSuccess;
    }

    /**
     * List website clones for given OrgId
     *
     * List of all website clones for the given OrgId.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteClones
     * GET /orgs/{org_id}/websites/clone
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsiteCloneFullListing|null
     */
    public function getWebsiteClones(?string $orgId = null): ?WebsiteCloneFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/clone");

        return $response->decoded !== null ? WebsiteCloneFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Clone website or push live
     *
     * Clone a website or push live to overwrite an existing live website with content from the source website. Operation is asynchronous and returns a clone id.
     * If includeDatabases is ommited, the all databases will be cloned from the source website. If includeDatabaseUsers is ommited, the all database users will be cloned from the source website.
     *
     * @link https://apidocs.enhance.com/#/websites/cloneWebsite
     * POST /orgs/{org_id}/websites/clone
     *
     * @param WebsiteCloneRequest $websiteCloneRequest
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function cloneWebsite(WebsiteCloneRequest $websiteCloneRequest, ?string $orgId = null): ?NewResourceUuid
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/clone", [], $websiteCloneRequest);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Get's detail about a single push live
     *
     * Fetches details about a single website clone. cloneWebsite call operation just enqueues the request and returns immediately. Use this endpoint to monitor how the clone finishes.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteClone
     * GET /orgs/{org_id}/websites/clone/{clone_id}
     *
     * @param string $cloneId The id of the website push live.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsiteCloneResponse|null
     */
    public function getWebsiteClone(string $cloneId, ?string $orgId = null): ?WebsiteCloneResponse
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/clone/{$cloneId}");

        return $response->decoded !== null ? WebsiteCloneResponse::fromArray($response->decoded) : null;
    }

    /**
     * Get the log for a given clone id..
     *
     * Fetches the import migration log for a single website clone.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteCloneLog
     * GET /orgs/{org_id}/websites/clone/{clone_id}/log
     *
     * @param string $cloneId The id of the website push live.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsiteCloneLogEntry[]
     */
    public function getWebsiteCloneLog(string $cloneId, ?string $orgId = null): array
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/clone/{$cloneId}/log");

        return array_map(static fn (array $item): WebsiteCloneLogEntry => WebsiteCloneLogEntry::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Get website
     *
     * Returns detailed information about a single website.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsite
     * GET /orgs/{org_id}/websites/{website_id}
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Website|null
     */
    public function getWebsite(string $websiteId, ?string $orgId = null): ?Website
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}");

        return $response->decoded !== null ? Website::fromArray($response->decoded) : null;
    }

    /**
     * Update website
     *
     * Updates the website.
     * It may be used to enable or disable a specific version of PHP for a website, in which case a corresponding `PhpCd` instance is installed or uninstalled on the same server of the website. When enabling the website PHP it is also possible to specify whether the SSH daemon will need to be enabled in the `PhpCd` service at startup, via the `ssh` boolean flag. Moreover, if PHP is already enabled for a website, it is possible to enable or disable its SSH by only specifying the `ssh` flag.
     * The endpoint is also responsible for assigning tags to a website. Note that the input overwrites all existing tags, so when adding a new tag, the `tags` property also has to include existing tags that are to be kept.
     * Only a parent organization or MO admin may suspend websites.
     * The website may be moved to another subscription, if that subscription has enough quota to accommodate the new website, unless the MO is performing the action, in which case they may move any website off a subscription or to a subscription that doesn't necessary have quota left.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/websites/updateWebsite
     * PATCH /orgs/{org_id}/websites/{website_id}
     *
     * @param string $websiteId The id of the website.
     * @param UpdateWebsite $updateWebsite Website update details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsite(string $websiteId, UpdateWebsite $updateWebsite, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}", [], $updateWebsite);

        return $response->isSuccess;
    }

    /**
     * Delete website
     *
     * Mark a website as deleted, which does not remove its data, or force remove all its data.
     * For removing all data and metadata belonging to a website (including DB records), pass the `force=true` query parameter. This can only be done by a privileged MO member. In this case, all data is wiped, so use carefully.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/websites/deleteWebsite
     * DELETE /orgs/{org_id}/websites/{website_id}
     *
     * @param string $websiteId The id of the website.
     * @param bool|null $force
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsite(string $websiteId, ?bool $force = null, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $query = [
            'force' => $force,
        ];
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}", $query);

        return $response->isSuccess;
    }

    /**
     * Get the status of an ongoing website backup operation
     *
     * Returns the status of the currently ongoing backup or restore, if any.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteBackupStatus
     * GET /orgs/{org_id}/websites/{website_id}/status/backup
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return BackupStatus|null
     */
    public function getWebsiteBackupStatus(string $websiteId, ?string $orgId = null): ?BackupStatus
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/status/backup");

        return $response->decoded !== null ? BackupStatus::fromArray($response->decoded) : null;
    }

    /**
     * Making a staging website live
     *
     * Validates that the operation is allowed for the website.
     * Session holder must be at least a `SuperAdmin` in the org which owns the website, or a parent org.
     * If the website is not owned by the MO, the subscription must have sufficient available 'websites' resource
     *
     * @link https://apidocs.enhance.com/#/websites/pushWebsiteLive
     * POST /orgs/{org_id}/websites/{website_id}/push-live
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function pushWebsiteLive(string $websiteId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/push-live");

        return $response->isSuccess;
    }

    /**
     * Get the value for a particular setting
     *
     * Returns the value for a particular setting as a JSON object
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteSetting
     * GET /orgs/{org_id}/websites/{website_id}/settings/{setting_kind}
     *
     * @param string $websiteId The id of the website.
     * @param SettingKind $settingKind The type of setting being applied
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function getWebsiteSetting(string $websiteId, SettingKind $settingKind, ?string $orgId = null): mixed
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/settings/{$settingKind->value}");

        return $response->decoded;
    }

    /**
     * Set a single override setting
     *
     * Set or replace a single website level service setting
     *
     * @link https://apidocs.enhance.com/#/websites/setWebsiteSetting
     * PUT /orgs/{org_id}/websites/{website_id}/settings/{setting_kind}/{setting_key}
     *
     * @param string $websiteId The id of the website.
     * @param SettingKind $settingKind The type of setting being applied
     * @param string $settingKey A key for updating an existing setting, some known values are - hard_delete_after_secs - letsencrypt_enabled - org_websites_same_server - screenshot_driver_pool_size - screenshot_interval - sged_smtp - smtp_smart_host - website_backup - default_dns_ttl
     * @param mixed $body
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteSetting(
        string $websiteId,
        SettingKind $settingKind,
        string $settingKey,
        mixed $body,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/settings/{$settingKind->value}/{$settingKey}", [], $body);

        return $response->isSuccess;
    }

    /**
     * Delete a single override setting
     *
     * Delete a single website level service setting
     *
     * @link https://apidocs.enhance.com/#/websites/deleteWebsiteSetting
     * DELETE /orgs/{org_id}/websites/{website_id}/settings/{setting_kind}/{setting_key}
     *
     * @param string $websiteId The id of the website.
     * @param SettingKind $settingKind The type of setting being applied
     * @param string $settingKey A key for updating an existing setting, some known values are - hard_delete_after_secs - letsencrypt_enabled - org_websites_same_server - screenshot_driver_pool_size - screenshot_interval - sged_smtp - smtp_smart_host - website_backup - default_dns_ttl
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteSetting(
        string $websiteId,
        SettingKind $settingKind,
        string $settingKey,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/settings/{$settingKind->value}/{$settingKey}");

        return $response->isSuccess;
    }

    /**
     * Validate whether a website operation is allowed
     *
     * Validates that the operation is allowed for the website.
     * Currently this is only for verifying whether a website may be moved to another subscription, but this could later be expanded with other actions that can be verified.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/websites/validateWebsiteOperation
     * POST /orgs/{org_id}/websites/{website_id}/validate-operation
     *
     * @param string $websiteId The id of the website.
     * @param WebsiteOperationValidation $websiteOperationValidation
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ValidationResult|null
     */
    public function validateWebsiteOperation(
        string $websiteId,
        WebsiteOperationValidation $websiteOperationValidation,
        ?string $orgId = null,
    ): ?ValidationResult {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/validate-operation", [], $websiteOperationValidation);

        return $response->decoded !== null ? ValidationResult::fromArray($response->decoded) : null;
    }

    /**
     * Get an access token for the given website
     *
     * Request an access token for the given website.
     * Note that access tokens may only be requested for normal websites, not for control panel websites.
     * The access token is returned as an encrypted JWT in the response body.
     * Session holder must either be a parent organization admin, or be a member with Site Access role of the given organization.
     *
     * @link https://apidocs.enhance.com/#/websites/getSiteAccessToken
     * POST /orgs/{org_id}/websites/{website_id}/access-tokens
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getSiteAccessToken(string $websiteId, ?string $orgId = null): ?string
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/access-tokens");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Reads chains of rewrite rules
     *
     * Rewrites are `RewriteRule`s in website's .htaccess.
     * We use terminology "rewrite chain" to refer to 0 or more `RewriteCond`s directive ended by a `RewriteRule`.
     * To identify a rewrite chain in the .htaccess file, we use line numbers.
     * Line numbers serve two purposes. It acts loosely as an identifier, i.e. if you want to remove some chain or replace it by another, you would use the same line number you received when you read the `GET` endpoint.
     * Second purpose is that of ordering. If you want some chain to be above another in the file, you have to make sure that the line number is less.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteHtaccessRewrites
     * GET /orgs/{org_id}/websites/{website_id}/htaccess
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return RewriteChainFullListing|null
     */
    public function getWebsiteHtaccessRewrites(string $websiteId, ?string $orgId = null): ?RewriteChainFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/htaccess");

        return $response->decoded !== null ? RewriteChainFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Updates rewrite rules
     *
     * Rewrites are `RewriteRule`s in website's .htaccess file.
     * We use terminology "rewrite chain" to refer to 0 or more `RewriteCond`s directive ended by `RewriteRule`.
     *
     * @link https://apidocs.enhance.com/#/websites/updateWebsiteHtaccessRewrites
     * PATCH /orgs/{org_id}/websites/{website_id}/htaccess
     *
     * @param string $websiteId The id of the website.
     * @param UpdateRewriteChainFullListing $updateRewriteChainFullListing List of rewrite chains to be inserted into the .htaccess file. To identify a rewrite chain in the .htaccess file, we use line numbers. Line numbers serve two purposes. It acts loosely as an identifier, i.e. if you want to remove some chain or replace it by another, you would use the same line number you received when you read the `GET` endpoint. Second purpose is that of ordering. If you want some chain to be above another in the file, you have to make sure that the line number is less. To delete a rewrite chain, just send a line number without any additional information for a single `RewriteChain` object.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsiteHtaccessRewrites(
        string $websiteId,
        UpdateRewriteChainFullListing $updateRewriteChainFullListing,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/htaccess", [], $updateRewriteChainFullListing);

        return $response->isSuccess;
    }

    /**
     * Returns current rules of blocked/whitelisted IPs
     *
     * Allowlisting or blocklisting IPs via .htaccess is done using Require ip rule. This endpoint reads the rules from the .htaccess in the website's public_html.
     * Note that this is not the same .htaccess that is used for writing redirect rules.
     * In future this endpoint might be merged with the htaccess endpoint to allow writing rewrite rules and ip allow lists to any website directory.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteHtaccessIpsRule
     * GET /orgs/{org_id}/websites/{website_id}/htaccess/ips
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return RequireIpsRule|null
     */
    public function getWebsiteHtaccessIpsRule(string $websiteId, ?string $orgId = null): ?RequireIpsRule
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/htaccess/ips");

        return $response->decoded !== null ? RequireIpsRule::fromArray($response->decoded) : null;
    }

    /**
     * Sets a rule over provided ips - either block or allow
     *
     * Allowlisting or blocklisting IPs via .htaccess is done using Require ip rule. This endpoint puts the rule (creating .htaccess if it doesn't exist in process) into the public_html/.htaccess file.
     * Note that this is not the same .htaccess that is used for writing redirect rules.
     * In future this endpoint might be merged with the htaccess endpoint to allow writing rewrite rules and ip allow lists to any website directory.
     *
     * @link https://apidocs.enhance.com/#/websites/updateWebsiteHtaccessIpsRule
     * PUT /orgs/{org_id}/websites/{website_id}/htaccess/ips
     *
     * @param string $websiteId The id of the website.
     * @param RequireIpsRule $requireIpsRule List of ips and a rule which should apply to them - either block all these ips or allow only these ips.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsiteHtaccessIpsRule(
        string $websiteId,
        RequireIpsRule $requireIpsRule,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/htaccess/ips", [], $requireIpsRule);

        return $response->isSuccess;
    }

    /**
     * Fetch website server domains
     *
     * This endpoint will return the server domain for the application, email and database roles to which this website is assigned.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteServerDomains
     * GET /orgs/{org_id}/websites/{website_id}/server_domains
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsiteServerDomains|null
     */
    public function getWebsiteServerDomains(string $websiteId, ?string $orgId = null): ?WebsiteServerDomains
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/server_domains");

        return $response->decoded !== null ? WebsiteServerDomains::fromArray($response->decoded) : null;
    }

    /**
     * Create a preview domain
     *
     * Creates a preview domain for the given website and returns its full domain.  If a preview domain already exists, returns that instead.  Will error if a preview domain cannot be created.
     * Returns 200 if an existing preview domain is returned and 201 if one has been created.
     *
     * @link https://apidocs.enhance.com/#/websites/createPreviewDomain
     * POST /orgs/{org_id}/websites/{website_id}/preview
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function createPreviewDomain(string $websiteId, ?string $orgId = null): ?string
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/preview");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Get the active cgroup limits for a website
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteCgroupLimits
     * GET /orgs/{org_id}/websites/{website_id}/cgroup_limits
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return CgroupLimits|null
     */
    public function getWebsiteCgroupLimits(string $websiteId, ?string $orgId = null): ?CgroupLimits
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/cgroup_limits");

        return $response->decoded !== null ? CgroupLimits::fromArray($response->decoded) : null;
    }

    /**
     * Set the active cgroup limits for a website (Master org only)
     *
     * @link https://apidocs.enhance.com/#/websites/setWebsiteCgroupLimits
     * PUT /orgs/{org_id}/websites/{website_id}/cgroup_limits
     *
     * @param string $websiteId The id of the website.
     * @param SetCgroupLimits $setCgroupLimits Cgroup limits.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteCgroupLimits(
        string $websiteId,
        SetCgroupLimits $setCgroupLimits,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/cgroup_limits", [], $setCgroupLimits);

        return $response->isSuccess;
    }

    /**
     * Get the container IP and host IP for this website
     *
     * Returns the IP of the website container and the host side (for database connections, etc)
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteContainerIp
     * GET /websites/{website_id}/container_ip
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ContainerIpInfo|null
     */
    public function getWebsiteContainerIp(string $websiteId): ?ContainerIpInfo
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/container_ip");

        return $response->decoded !== null ? ContainerIpInfo::fromArray($response->decoded) : null;
    }

    /**
     * Get the LSPHP settings for this website
     *
     * Only for websites on Litespeed or Openlitespeed
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteLsphpSettings
     * GET /websites/{website_id}/lsphp_settings
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LsphpSettings|null
     */
    public function getWebsiteLsphpSettings(string $websiteId): ?LsphpSettings
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/lsphp_settings");

        return $response->decoded !== null ? LsphpSettings::fromArray($response->decoded) : null;
    }

    /**
     * Set the LSPHP settings for this website
     *
     * Only for websites on Litespeed or Openlitespeed
     *
     * @link https://apidocs.enhance.com/#/websites/setWebsiteLsphpSettings
     * PUT /websites/{website_id}/lsphp_settings
     *
     * @param string $websiteId The id of the website.
     * @param LsphpSettings $lsphpSettings Cgroup limits.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteLsphpSettings(string $websiteId, LsphpSettings $lsphpSettings): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/websites/{$websiteId}/lsphp_settings", [], $lsphpSettings);

        return $response->isSuccess;
    }

    /**
     * Get backups disabled status on a website
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteBackupsDisabledStatus
     * GET /websites/{website_id}/backups_disabled
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool|null
     */
    public function getWebsiteBackupsDisabledStatus(string $websiteId): ?bool
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/backups_disabled");

        return $response->decoded === null ? null : (bool)$response->decoded;
    }

    /**
     * Set backups disabled status on a website
     *
     * This will prevent automatic and manual backups from being taken.  This is a master org level setting and overrides any other settings.
     *
     * @link https://apidocs.enhance.com/#/websites/setWebsiteBackupsDisabledStatus
     * PUT /websites/{website_id}/backups_disabled
     *
     * @param string $websiteId The id of the website.
     * @param bool $value Backups disabled boolean
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteBackupsDisabledStatus(string $websiteId, ?bool $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/websites/{$websiteId}/backups_disabled", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get the active FS quoa limits for a website
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteFsQuotaLimits
     * GET /orgs/{org_id}/websites/{website_id}/fs_quota_limits
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return FsQuotaInfo|null
     */
    public function getWebsiteFsQuotaLimits(string $websiteId, ?string $orgId = null): ?FsQuotaInfo
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/fs_quota_limits");

        return $response->decoded !== null ? FsQuotaInfo::fromArray($response->decoded) : null;
    }

    /**
     * Set the active FS quota limits for a website (Master org only)
     *
     * @link https://apidocs.enhance.com/#/websites/setWebsiteFsQuotaLimits
     * PUT /orgs/{org_id}/websites/{website_id}/fs_quota_limits
     *
     * @param string $websiteId The id of the website.
     * @param FsQuotaLimit $fsQuotaLimit FS quota limits.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteFsQuotaLimits(
        string $websiteId,
        FsQuotaLimit $fsQuotaLimit,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/fs_quota_limits", [], $fsQuotaLimit);

        return $response->isSuccess;
    }

    /**
     * Get website's mapped domains
     *
     * Returns a list of domains that are mapped to this website. Requires login to have admin privileges in this org.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteDomainMappings
     * GET /orgs/{org_id}/websites/{website_id}/domains
     *
     * @param string $websiteId The id of the website.
     * @param bool|null $withSsl If set to true, domains are returned with applicable ssl certificates.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DomainMappingsFullListing|null
     */
    public function getWebsiteDomainMappings(
        string $websiteId,
        ?bool $withSsl = null,
        ?string $orgId = null,
    ): ?DomainMappingsFullListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'withSsl' => $withSsl,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/domains", $query);

        return $response->decoded !== null ? DomainMappingsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create website mapped domain
     *
     * Creates a domain mapping, where subscription resources are sufficient. The mapping kind will default to 'alias' if unspecified.
     *
     * @link https://apidocs.enhance.com/#/websites/createWebsiteMappedDomain
     * POST /orgs/{org_id}/websites/{website_id}/domains
     *
     * @param string $websiteId The id of the website.
     * @param NewMappedDomain $newMappedDomain Domain details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createWebsiteMappedDomain(
        string $websiteId,
        NewMappedDomain $newMappedDomain,
        ?string $orgId = null,
    ): ?NewResourceUuid {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/domains", [], $newMappedDomain);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Returns website domain mapping
     *
     * Returns a domain by its id that is mapped to this website. Requires login to have admin privileges in this org. Since only the MO can create standalone domains, session holder must be at least a `SuperAdmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteDomainMapping
     * GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DomainMapping|null
     */
    public function getWebsiteDomainMapping(
        string $websiteId,
        string $domainId,
        ?string $orgId = null,
    ): ?DomainMapping {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}");

        return $response->decoded !== null ? DomainMapping::fromArray($response->decoded) : null;
    }

    /**
     * Update website domain mapping
     *
     * Partially updates the domain mapping.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/websites/updateWebsiteDomainMapping
     * PATCH /orgs/{org_id}/websites/{website_id}/domains/{domain_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param DomainMappingUpdate $domainMappingUpdate
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsiteDomainMapping(
        string $websiteId,
        string $domainId,
        DomainMappingUpdate $domainMappingUpdate,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}", [], $domainMappingUpdate);

        return $response->isSuccess;
    }

    /**
     * Delete website domain mapping
     *
     * Deletes the domain mapping and decrements the domain alias quota usage in the website's subscription, if applicable.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/websites/deleteWebsiteDomainMapping
     * DELETE /orgs/{org_id}/websites/{website_id}/domains/{domain_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteWebsiteDomainMapping(string $websiteId, string $domainId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}");

        return $response->isSuccess;
    }

    /**
     * Returns website domain mapping DNS status
     *
     * Returns an indication of whether the domain correctly resolves to the server this website is on.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteDomainMappingDnsStatus
     * GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-status
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DnsStatus|null
     */
    public function getWebsiteDomainMappingDnsStatus(
        string $websiteId,
        string $domainId,
        ?string $orgId = null,
    ): ?DnsStatus {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/dns-status");

        return \is_string($response->decoded) || \is_int($response->decoded) ? DnsStatus::tryFrom($response->decoded) : null;
    }

    /**
     * Update primary domain mapping
     *
     * This operation can only be done by a logged in superadmin or owner of the organization or its parent organization(s). Domain and website has to belong to this organization.
     *
     * @link https://apidocs.enhance.com/#/websites/updateWebsitePrimaryDomain
     * PUT /orgs/{org_id}/websites/{website_id}/domains/primary
     *
     * @param string $websiteId The id of the website.
     * @param NewPrimaryDomainMapping $newPrimaryDomainMapping Domain mapping details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsitePrimaryDomain(
        string $websiteId,
        NewPrimaryDomainMapping $newPrimaryDomainMapping,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/websites/{$websiteId}/domains/primary", [], $newPrimaryDomainMapping);

        return $response->isSuccess;
    }

    /**
     * Recursively query Dns servers for given domain
     *
     * Returns details about the dns servers of given domain.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteDomainDnsQuery
     * GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/dns-query
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $resolveDepth DNS query resolve depth, defaults to `short` if not provided. `short` -> takes the shortest path to resolve domain IP. `detailed` -> queries and returns output from all found Authoritative name servers. `queryAllTldNs` -> queries and returns results from all TLD name servers (very expensive).
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DnsQueryOutcome|null
     */
    public function getWebsiteDomainDnsQuery(
        string $websiteId,
        string $domainId,
        ?string $resolveDepth = null,
        ?string $orgId = null,
    ): ?DnsQueryOutcome {
        $orgId = $this->orgId($orgId);
        $query = [
            'resolveDepth' => $resolveDepth,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/dns-query", $query);

        return $response->decoded !== null ? DnsQueryOutcome::fromArray($response->decoded) : null;
    }

    /**
     * Take website screenshot immediately
     *
     * @link https://apidocs.enhance.com/#/websites/takeScreenshot
     * POST /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/screenshot/take
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function takeScreenshot(string $websiteId, string $domainId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/screenshot/take");

        return $response->isSuccess;
    }

    /**
     * Get last screeshot file's Timestamp
     *
     * Returns Unix Timestamp for the last screenshot png file, if no screenshot found returns undefined
     *
     * @link https://apidocs.enhance.com/#/websites/getScreenshotTimestamp
     * GET /orgs/{org_id}/websites/{website_id}/domains/{domain_id}/screenshot/timestamp
     *
     * @param string $websiteId The id of the website.
     * @param string $domainId The id of the domain.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return UnixTimestamp|null
     */
    public function getScreenshotTimestamp(string $websiteId, string $domainId, ?string $orgId = null): ?UnixTimestamp
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/domains/{$domainId}/screenshot/timestamp");

        return $response->decoded !== null ? UnixTimestamp::fromArray($response->decoded) : null;
    }

    /**
     * Get website's authorized SSH keys
     *
     * Returns a list of authorized public SSH keys. Invalid SSH keys entries in the authorized_keys file will be ignored. If the authorized_keys file does not exists, an empty set will be returned.
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteSshKeys
     * GET /orgs/{org_id}/websites/{website_id}/ssh/keys
     *
     * @param string $websiteId The id of the website.
     * @param bool|null $sanitize If set to true, the SSH keys with unrecognized comments will be sanitized by changing the comment to a valid format that can be used to store metadata. If any of the keys requires sanitization the content of the authorized_keys file will be edited accordingly before returning the set of keys. If instead set to false, only the SSH keys that are recognized as valid (that is, contain valid metadata in their comments), will be returned, all the other keys will be skipped.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return SshKeyFullListing|null
     */
    public function getWebsiteSshKeys(
        string $websiteId,
        ?bool $sanitize = null,
        ?string $orgId = null,
    ): ?SshKeyFullListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'sanitize' => $sanitize,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/ssh/keys", $query);

        return $response->decoded !== null ? SshKeyFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Authorize a new SSH key.
     *
     * This operation will authorize the given public SSH key by appending its content to the website's .ssh/authorized_keys file.
     *
     * @link https://apidocs.enhance.com/#/websites/authorizeWebsiteSshKey
     * POST /orgs/{org_id}/websites/{website_id}/ssh/keys
     *
     * @param string $websiteId The id of the website.
     * @param NewSshKey $newSshKey The public SSH key to authorize.
     * @param bool|null $sanitize If set to true, the SSH keys with unrecognized comments will be sanitized by changing the comment to a valid format that can be used to store metadata. If any of the keys requires sanitization the content of the authorized_keys file will be edited accordingly before returning the set of keys. If instead set to false, only the SSH keys that are recognized as valid (that is, contain valid metadata in their comments), will be returned, all the other keys will be skipped.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewSshKeyId|null
     */
    public function authorizeWebsiteSshKey(
        string $websiteId,
        NewSshKey $newSshKey,
        ?bool $sanitize = null,
        ?string $orgId = null,
    ): ?NewSshKeyId {
        $orgId = $this->orgId($orgId);
        $query = [
            'sanitize' => $sanitize,
        ];
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/ssh/keys", $query, $newSshKey);

        return $response->decoded !== null ? NewSshKeyId::fromArray($response->decoded) : null;
    }

    /**
     * Update an existing website public SSH key.
     *
     * This operation will update the given public SSH key value, and/or its associated friendly name. An error will be returned if none of the expected arguments of the request body is specified.
     *
     * @link https://apidocs.enhance.com/#/websites/updateWebsiteSshKey
     * PATCH /orgs/{org_id}/websites/{website_id}/ssh/keys/{key_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $keyId The unique ID of the SSH key within the same authorized_keys file.
     * @param SshKeyUpdate $sshKeyUpdate The public SSH key updatable fields.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateWebsiteSshKey(
        string $websiteId,
        string $keyId,
        SshKeyUpdate $sshKeyUpdate,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/ssh/keys/{$keyId}", [], $sshKeyUpdate);

        return $response->isSuccess;
    }

    /**
     * Unauthorize the public SSH key with the given ID.
     *
     * This operation will unauthorize the given public SSH key by deleting its content from the website's .ssh/authorized_keys file.
     *
     * @link https://apidocs.enhance.com/#/websites/unauthorizeWebsiteSshKey
     * DELETE /orgs/{org_id}/websites/{website_id}/ssh/keys/{key_id}
     *
     * @param string $websiteId The id of the website.
     * @param string $keyId The unique ID of the SSH key within the same authorized_keys file.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function unauthorizeWebsiteSshKey(string $websiteId, string $keyId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/ssh/keys/{$keyId}");

        return $response->isSuccess;
    }

    /**
     * Authorize a new SSH password for website.
     *
     * This operation will authorize the given SSH password for the website's unix user. this request will replace the existing password for the user if already set.
     *
     * @link https://apidocs.enhance.com/#/websites/authorizeWebsiteSshPassword
     * POST /orgs/{org_id}/websites/{website_id}/ssh/password
     *
     * @param string $websiteId The id of the website.
     * @param NewPassword $newPassword The SSH password to authorize.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function authorizeWebsiteSshPassword(
        string $websiteId,
        NewPassword $newPassword,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/websites/{$websiteId}/ssh/password", [], $newPassword);

        return $response->isSuccess;
    }

    /**
     * Get user's crontab
     *
     * Get user's crontab.
     * Only editable parts of crontab is returned.
     *
     * @link https://apidocs.enhance.com/#/websites/getUserCrontab
     * GET /orgs/{org_id}/websites/{website_id}/crontab
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return CrontabFullListing|null
     */
    public function getUserCrontab(string $websiteId, ?string $orgId = null): ?CrontabFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/crontab");

        return $response->decoded !== null ? CrontabFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Update user's crontab
     *
     * Update user's crontab.
     * Note that users are able to update only cron expressions and environment variables.
     *
     * @link https://apidocs.enhance.com/#/websites/updateUserCrontab
     * PATCH /orgs/{org_id}/websites/{website_id}/crontab
     *
     * @param string $websiteId The id of the website.
     * @param UpdateCrontabFullListing $updateCrontabFullListing List of crontab expressions to be inserted into user's crontab. To identify a crontab expressions in the crontab file, we use line numbers.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateUserCrontab(
        string $websiteId,
        UpdateCrontabFullListing $updateCrontabFullListing,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/websites/{$websiteId}/crontab", [], $updateCrontabFullListing);

        return $response->isSuccess;
    }

    /**
     * Delete user's crontab
     *
     * Delete user's crontab.
     * Remove crontab file from disk.
     *
     * @link https://apidocs.enhance.com/#/websites/deleteUserCrontab
     * DELETE /orgs/{org_id}/websites/{website_id}/crontab
     *
     * @param string $websiteId The id of the website.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteUserCrontab(string $websiteId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/websites/{$websiteId}/crontab");

        return $response->isSuccess;
    }

    /**
     * Get status of Nginx FastCGI enablement
     *
     * @link https://apidocs.enhance.com/#/websites/getDomainNginxFastCgi
     * GET /v2/domains/{domain_id}/nginx_fastcgi
     *
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool|null
     */
    public function getDomainNginxFastCgi(string $domainId): ?bool
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/domains/{$domainId}/nginx_fastcgi");

        return $response->decoded === null ? null : (bool)$response->decoded;
    }

    /**
     * Set Nginx FastCGI enablement
     *
     * @link https://apidocs.enhance.com/#/websites/setDomainNginxFastCgi
     * PUT /v2/domains/{domain_id}/nginx_fastcgi
     *
     * @param string $domainId The id of the domain.
     * @param bool $value Boolean value, set true to enable and false to disable FastCGI cache.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setDomainNginxFastCgi(string $domainId, ?bool $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/domains/{$domainId}/nginx_fastcgi", [], $value);

        return $response->isSuccess;
    }

    /**
     * Clear FastCGI cache for domain
     *
     * @link https://apidocs.enhance.com/#/websites/clearDomainNginxFastCgi
     * DELETE /v2/domains/{domain_id}/nginx_fastcgi
     *
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function clearDomainNginxFastCgi(string $domainId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/v2/domains/{$domainId}/nginx_fastcgi");

        return $response->isSuccess;
    }

    /**
     * Get Nginx FastCGI excluded paths
     *
     * @link https://apidocs.enhance.com/#/websites/getDomainNginxFastCgiExcludedPaths
     * GET /v2/domains/{domain_id}/nginx_fastcgi_excluded_paths
     *
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function getDomainNginxFastCgiExcludedPaths(string $domainId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/domains/{$domainId}/nginx_fastcgi_excluded_paths");

        return (array)($response->decoded ?? []);
    }

    /**
     * Add Nginx FastCGI excluded path
     *
     * @link https://apidocs.enhance.com/#/websites/addDomainNginxFastCgiExcludedPath
     * POST /v2/domains/{domain_id}/nginx_fastcgi_excluded_paths
     *
     * @param string $domainId The id of the domain.
     * @param string $value Exclude the following path from nginx fastcgi cache.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function addDomainNginxFastCgiExcludedPath(string $domainId, ?string $value): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/v2/domains/{$domainId}/nginx_fastcgi_excluded_paths", [], $value);

        return $response->isSuccess;
    }

    /**
     * Delete Nginx FastCGI excluded path
     *
     * @link https://apidocs.enhance.com/#/websites/deleteDomainNginxFastCgiExcludedPath
     * DELETE /v2/domains/{domain_id}/nginx_fastcgi_excluded_paths
     *
     * @param string $domainId The id of the domain.
     * @param string|null $path
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteDomainNginxFastCgiExcludedPath(string $domainId, ?string $path = null): bool
    {
        $query = [
            'path' => $path,
        ];
        $response = $this->client->request(HttpMethod::DELETE, "/v2/domains/{$domainId}/nginx_fastcgi_excluded_paths", $query);

        return $response->isSuccess;
    }

    /**
     * Get web server rewrites for specified domain
     *
     * @link https://apidocs.enhance.com/#/websites/getDomainWebserverRewrites
     * GET /v2/domains/{domain_id}/webserver_rewrites
     *
     * @param string $domainId The id of the domain.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebServerRewrite[]
     */
    public function getDomainWebserverRewrites(string $domainId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/domains/{$domainId}/webserver_rewrites");

        return array_map(static fn (array $item): WebServerRewrite => WebServerRewrite::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Set web server rewrite to file
     *
     * @link https://apidocs.enhance.com/#/websites/setDomainWebserverRewrite
     * PUT /v2/domains/{domain_id}/webserver_rewrites
     *
     * @param string $domainId The id of the domain.
     * @param WebServerRewrite $webServerRewrite Rewrite a path to a file
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setDomainWebserverRewrite(string $domainId, WebServerRewrite $webServerRewrite): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/domains/{$domainId}/webserver_rewrites", [], $webServerRewrite);

        return $response->isSuccess;
    }

    /**
     * Delete web server rewrite
     *
     * @link https://apidocs.enhance.com/#/websites/deleteDomainWebserverRewrite
     * DELETE /v2/domains/{domain_id}/webserver_rewrites
     *
     * @param string $domainId The id of the domain.
     * @param string|null $path
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteDomainWebserverRewrite(string $domainId, ?string $path = null): bool
    {
        $query = [
            'path' => $path,
        ];
        $response = $this->client->request(HttpMethod::DELETE, "/v2/domains/{$domainId}/webserver_rewrites", $query);

        return $response->isSuccess;
    }

    /**
     * Get web server kind for a given website
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteWebserverKind
     * GET /v2/websites/{website_id}/webserver_kind
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebserverKind|null
     */
    public function getWebsiteWebserverKind(string $websiteId): ?WebserverKind
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/websites/{$websiteId}/webserver_kind");

        return \is_string($response->decoded) || \is_int($response->decoded) ? WebserverKind::tryFrom($response->decoded) : null;
    }

    /**
     * Get ioncube status for an existing website
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteIoncubeStatus
     * GET /v2/websites/{website_id}/ioncube
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool|null
     */
    public function getWebsiteIoncubeStatus(string $websiteId): ?bool
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/websites/{$websiteId}/ioncube");

        return $response->decoded === null ? null : (bool)$response->decoded;
    }

    /**
     * Set ioncube status for an existing website
     *
     * @link https://apidocs.enhance.com/#/websites/setWebsiteIoncubeStatus
     * PUT /v2/websites/{website_id}/ioncube
     *
     * @param string $websiteId The id of the website.
     * @param bool $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteIoncubeStatus(string $websiteId, ?bool $value = null): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/websites/{$websiteId}/ioncube", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get redis state for a website
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteRedisState
     * GET /v2/websites/{website_id}/redis
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool|null
     */
    public function getWebsiteRedisState(string $websiteId): ?bool
    {
        $response = $this->client->request(HttpMethod::GET, "/v2/websites/{$websiteId}/redis");

        return $response->decoded === null ? null : (bool)$response->decoded;
    }

    /**
     * Set Redis state for an existing website
     *
     * @link https://apidocs.enhance.com/#/websites/setWebsiteRedisState
     * PUT /v2/websites/{website_id}/redis
     *
     * @param string $websiteId The id of the website.
     * @param bool $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setWebsiteRedisState(string $websiteId, ?bool $value = null): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/websites/{$websiteId}/redis", [], $value);

        return $response->isSuccess;
    }

    /**
     * Restart PHP container for a website
     *
     * @link https://apidocs.enhance.com/#/websites/restartWebsitePhp
     * POST /v2/websites/{website_id}/restart_php
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function restartWebsitePhp(string $websiteId): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/v2/websites/{$websiteId}/restart_php");

        return $response->isSuccess;
    }

    /**
     * Get last 256KB of PHP error log
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsitePhpErrorLog
     * GET /websites/{website_id}/php_error_log
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getWebsitePhpErrorLog(string $websiteId): ?string
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/php_error_log");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Get enabled PHP extensions
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteEnabledPhpExtensions
     * GET /websites/{website_id}/php_extensions
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function getWebsiteEnabledPhpExtensions(string $websiteId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/php_extensions");

        return (array)($response->decoded ?? []);
    }

    /**
     * Enable a PHP extension
     *
     * @link https://apidocs.enhance.com/#/websites/enableWebsitePhpExtension
     * POST /websites/{website_id}/php_extensions
     *
     * @param string $websiteId The id of the website.
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function enableWebsitePhpExtension(string $websiteId, ?string $value = null): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/websites/{$websiteId}/php_extensions", [], $value);

        return $response->isSuccess;
    }

    /**
     * Disable a PHP extension
     *
     * @link https://apidocs.enhance.com/#/websites/disableWebsitePhpExtension
     * DELETE /websites/{website_id}/php_extensions
     *
     * @param string $websiteId The id of the website.
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function disableWebsitePhpExtension(string $websiteId, ?string $value = null): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/websites/{$websiteId}/php_extensions", [], $value);

        return $response->isSuccess;
    }

    /**
     * Get available PHP extensions for a website
     *
     * @link https://apidocs.enhance.com/#/websites/getWebsiteAvailablePhpExtensions
     * GET /websites/{website_id}/available_php_extensions
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function getWebsiteAvailablePhpExtensions(string $websiteId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/available_php_extensions");

        return (array)($response->decoded ?? []);
    }

    /**
     * Get a list of the PHP extensions compiled in to the currently selected version of PHP for this website
     *
     * @link https://apidocs.enhance.com/#/websites/getBuiltInPhpExtensions
     * GET /websites/{website_id}/built_in_php_extensions
     *
     * @param string $websiteId The id of the website.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return array<int, mixed>
     */
    public function getBuiltInPhpExtensions(string $websiteId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/websites/{$websiteId}/built_in_php_extensions");

        return (array)($response->decoded ?? []);
    }
}
