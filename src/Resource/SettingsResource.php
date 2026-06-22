<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\BackupRemoteStorageS3;
use GoSuccess\Enhance\DTO\CreateBackupRemoteStorageS3;
use GoSuccess\Enhance\DTO\DemoMode;
use GoSuccess\Enhance\DTO\OrchdLoginPolicyEmailList;
use GoSuccess\Enhance\DTO\OrchdLoginPolicyIpList;
use GoSuccess\Enhance\DTO\OrchdLoginPolicySettings;
use GoSuccess\Enhance\DTO\OrchdLogSettings;
use GoSuccess\Enhance\DTO\Setting;
use GoSuccess\Enhance\DTO\SettingsFullListing;
use GoSuccess\Enhance\DTO\UpdateBackupRemoteStorageS3;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Enum\Outcome;
use GoSuccess\Enhance\Enum\SettingKind;

/**
 * Operations for the "settings" section of the Enhance API.
 */
final class SettingsResource extends AbstractResource
{
    /**
     * Get all current settings
     *
     * @link https://apidocs.enhance.com/#/settings/getSettings
     * GET /settings
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return SettingsFullListing|null
     */
    public function getSettings(): ?SettingsFullListing
    {
        $response = $this->client->request(HttpMethod::GET, '/settings');

        return $response->decoded !== null ? SettingsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create settings
     *
     * @link https://apidocs.enhance.com/#/settings/createSettings
     * POST /settings
     *
     * @param array<int, mixed> $items
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createSettings(?array $items): bool
    {
        $response = $this->client->request(HttpMethod::POST, '/settings', [], $items);

        return $response->isSuccess;
    }

    /**
     * Get the orchd log settings
     *
     * @link https://apidocs.enhance.com/#/settings/getOrchdLogSettings
     * GET /settings/orchd/logs
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return OrchdLogSettings|null
     */
    public function getOrchdLogSettings(): ?OrchdLogSettings
    {
        $response = $this->client->request(HttpMethod::GET, '/settings/orchd/logs');

        return $response->decoded !== null ? OrchdLogSettings::fromArray($response->decoded) : null;
    }

    /**
     * Set the orchd log settings
     *
     * @link https://apidocs.enhance.com/#/settings/setOrchdLogSettings
     * PUT /settings/orchd/logs
     *
     * @param OrchdLogSettings $orchdLogSettings
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setOrchdLogSettings(OrchdLogSettings $orchdLogSettings): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/settings/orchd/logs', [], $orchdLogSettings);

        return $response->isSuccess;
    }

    /**
     * Get the platform level prohibited domains as a newline separated list
     *
     * @link https://apidocs.enhance.com/#/settings/getProhibitedDomains
     * GET /settings/orchd/prohibited_domains
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getProhibitedDomains(): ?string
    {
        $response = $this->client->request(HttpMethod::GET, '/settings/orchd/prohibited_domains');

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Set the platform level prohibited domains
     *
     * @link https://apidocs.enhance.com/#/settings/setProhibitedDomains
     * PUT /settings/orchd/prohibited_domains
     *
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setProhibitedDomains(?string $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/settings/orchd/prohibited_domains', [], $value);

        return $response->isSuccess;
    }

    /**
     * Get the orchd login policy settings
     *
     * @link https://apidocs.enhance.com/#/settings/getOrchdLoginPolicySettings
     * GET /settings/orchd/login-policy/settings
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return OrchdLoginPolicySettings|null
     */
    public function getOrchdLoginPolicySettings(): ?OrchdLoginPolicySettings
    {
        $response = $this->client->request(HttpMethod::GET, '/settings/orchd/login-policy/settings');

        return $response->decoded !== null ? OrchdLoginPolicySettings::fromArray($response->decoded) : null;
    }

    /**
     * Set a single orchd login policy setting
     *
     * @link https://apidocs.enhance.com/#/settings/addOrchdLoginPolicySettings
     * PUT /settings/orchd/login-policy/settings
     *
     * @param OrchdLoginPolicySettings $orchdLoginPolicySettings
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function addOrchdLoginPolicySettings(OrchdLoginPolicySettings $orchdLoginPolicySettings): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/settings/orchd/login-policy/settings', [], $orchdLoginPolicySettings);

        return $response->isSuccess;
    }

    /**
     * Get the orchd login policy ip whitelist
     *
     * @link https://apidocs.enhance.com/#/settings/getOrchdLoginPolicyIpWhitelist
     * GET /settings/orchd/login-policy/ip-whitelist
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return OrchdLoginPolicyIpList|null
     */
    public function getOrchdLoginPolicyIpWhitelist(): ?OrchdLoginPolicyIpList
    {
        $response = $this->client->request(HttpMethod::GET, '/settings/orchd/login-policy/ip-whitelist');

        return $response->decoded !== null ? OrchdLoginPolicyIpList::fromArray($response->decoded) : null;
    }

    /**
     * Set the orchd login policy ip whitelist as a whole
     *
     * @link https://apidocs.enhance.com/#/settings/addOrchdLoginPolicyIpWhitelist
     * PUT /settings/orchd/login-policy/ip-whitelist
     *
     * @param OrchdLoginPolicyIpList $orchdLoginPolicyIpList
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function addOrchdLoginPolicyIpWhitelist(OrchdLoginPolicyIpList $orchdLoginPolicyIpList): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/settings/orchd/login-policy/ip-whitelist', [], $orchdLoginPolicyIpList);

        return $response->isSuccess;
    }

    /**
     * Delete an orchd login policy ip whitelist
     *
     * @link https://apidocs.enhance.com/#/settings/deleteOrchdLoginPolicyIpWhitelist
     * DELETE /settings/orchd/login-policy/ip-whitelist
     *
     * @param OrchdLoginPolicyIpList $orchdLoginPolicyIpList
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteOrchdLoginPolicyIpWhitelist(OrchdLoginPolicyIpList $orchdLoginPolicyIpList): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, '/settings/orchd/login-policy/ip-whitelist', [], $orchdLoginPolicyIpList);

        return $response->isSuccess;
    }

    /**
     * Get the orchd login policy ip blacklist
     *
     * @link https://apidocs.enhance.com/#/settings/getOrchdLoginPolicyIpBlacklist
     * GET /settings/orchd/login-policy/ip-blacklist
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return OrchdLoginPolicyIpList|null
     */
    public function getOrchdLoginPolicyIpBlacklist(): ?OrchdLoginPolicyIpList
    {
        $response = $this->client->request(HttpMethod::GET, '/settings/orchd/login-policy/ip-blacklist');

        return $response->decoded !== null ? OrchdLoginPolicyIpList::fromArray($response->decoded) : null;
    }

    /**
     * Set the orchd login policy ip blacklist as a whole
     *
     * @link https://apidocs.enhance.com/#/settings/addOrchdLoginPolicyIpBlacklist
     * PUT /settings/orchd/login-policy/ip-blacklist
     *
     * @param OrchdLoginPolicyIpList $orchdLoginPolicyIpList
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function addOrchdLoginPolicyIpBlacklist(OrchdLoginPolicyIpList $orchdLoginPolicyIpList): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/settings/orchd/login-policy/ip-blacklist', [], $orchdLoginPolicyIpList);

        return $response->isSuccess;
    }

    /**
     * Delete an orchd login policy ip blacklist
     *
     * @link https://apidocs.enhance.com/#/settings/deleteOrchdLoginPolicyIpBlacklist
     * DELETE /settings/orchd/login-policy/ip-blacklist
     *
     * @param OrchdLoginPolicyIpList $orchdLoginPolicyIpList
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteOrchdLoginPolicyIpBlacklist(OrchdLoginPolicyIpList $orchdLoginPolicyIpList): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, '/settings/orchd/login-policy/ip-blacklist', [], $orchdLoginPolicyIpList);

        return $response->isSuccess;
    }

    /**
     * Get the orchd login policy email whitelist
     *
     * @link https://apidocs.enhance.com/#/settings/getOrchdLoginPolicyEmailWhitelist
     * GET /settings/orchd/login-policy/email-whitelist
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return OrchdLoginPolicyEmailList|null
     */
    public function getOrchdLoginPolicyEmailWhitelist(): ?OrchdLoginPolicyEmailList
    {
        $response = $this->client->request(HttpMethod::GET, '/settings/orchd/login-policy/email-whitelist');

        return $response->decoded !== null ? OrchdLoginPolicyEmailList::fromArray($response->decoded) : null;
    }

    /**
     * Set the orchd login policy email whitelist as a whole
     *
     * @link https://apidocs.enhance.com/#/settings/addOrchdLoginPolicyEmailWhitelist
     * PUT /settings/orchd/login-policy/email-whitelist
     *
     * @param OrchdLoginPolicyEmailList $orchdLoginPolicyEmailList
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function addOrchdLoginPolicyEmailWhitelist(OrchdLoginPolicyEmailList $orchdLoginPolicyEmailList): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/settings/orchd/login-policy/email-whitelist', [], $orchdLoginPolicyEmailList);

        return $response->isSuccess;
    }

    /**
     * Delete an orchd login policy email whitelist
     *
     * @link https://apidocs.enhance.com/#/settings/deleteOrchdLoginPolicyEmailWhitelist
     * DELETE /settings/orchd/login-policy/email-whitelist
     *
     * @param OrchdLoginPolicyEmailList $orchdLoginPolicyEmailList
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteOrchdLoginPolicyEmailWhitelist(OrchdLoginPolicyEmailList $orchdLoginPolicyEmailList): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, '/settings/orchd/login-policy/email-whitelist', [], $orchdLoginPolicyEmailList);

        return $response->isSuccess;
    }

    /**
     * Get the orchd login policy email blacklist
     *
     * @link https://apidocs.enhance.com/#/settings/getOrchdLoginPolicyEmailBlacklist
     * GET /settings/orchd/login-policy/email-blacklist
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return OrchdLoginPolicyEmailList|null
     */
    public function getOrchdLoginPolicyEmailBlacklist(): ?OrchdLoginPolicyEmailList
    {
        $response = $this->client->request(HttpMethod::GET, '/settings/orchd/login-policy/email-blacklist');

        return $response->decoded !== null ? OrchdLoginPolicyEmailList::fromArray($response->decoded) : null;
    }

    /**
     * Set the orchd login policy email blacklist as a whole
     *
     * @link https://apidocs.enhance.com/#/settings/addOrchdLoginPolicyEmailBlacklist
     * PUT /settings/orchd/login-policy/email-blacklist
     *
     * @param OrchdLoginPolicyEmailList $orchdLoginPolicyEmailList
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function addOrchdLoginPolicyEmailBlacklist(OrchdLoginPolicyEmailList $orchdLoginPolicyEmailList): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/settings/orchd/login-policy/email-blacklist', [], $orchdLoginPolicyEmailList);

        return $response->isSuccess;
    }

    /**
     * Delete an orchd login policy email blacklist
     *
     * @link https://apidocs.enhance.com/#/settings/deleteOrchdLoginPolicyEmailBlacklist
     * DELETE /settings/orchd/login-policy/email-blacklist
     *
     * @param OrchdLoginPolicyEmailList $orchdLoginPolicyEmailList
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteOrchdLoginPolicyEmailBlacklist(OrchdLoginPolicyEmailList $orchdLoginPolicyEmailList): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, '/settings/orchd/login-policy/email-blacklist', [], $orchdLoginPolicyEmailList);

        return $response->isSuccess;
    }

    /**
     * Check if master organisation IP lockdown is enabled
     *
     * @link https://apidocs.enhance.com/#/settings/getAdminLockdownStatus
     * GET /settings/orchd/admin-lockdown/status
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool|null
     */
    public function getAdminLockdownStatus(): ?bool
    {
        $response = $this->client->request(HttpMethod::GET, '/settings/orchd/admin-lockdown/status');

        return $response->decoded === null ? null : (bool)$response->decoded;
    }

    /**
     * Set admin lockdown status
     *
     * @link https://apidocs.enhance.com/#/settings/setAdminLockdownStatus
     * PUT /settings/orchd/admin-lockdown/status
     *
     * @param bool $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setAdminLockdownStatus(?bool $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/settings/orchd/admin-lockdown/status', [], $value);

        return $response->isSuccess;
    }

    /**
     * Get the list of allowed IPs for master organisation login, line separated
     *
     * @link https://apidocs.enhance.com/#/settings/getAdminLockdownList
     * GET /settings/orchd/admin-lockdown/list
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getAdminLockdownList(): ?string
    {
        $response = $this->client->request(HttpMethod::GET, '/settings/orchd/admin-lockdown/list');

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Set admin lockdown list as a whole
     *
     * @link https://apidocs.enhance.com/#/settings/setAdminLockdownList
     * PUT /settings/orchd/admin-lockdown/list
     *
     * @param string $value
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setAdminLockdownList(?string $value): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/settings/orchd/admin-lockdown/list', [], $value);

        return $response->isSuccess;
    }

    /**
     * Get the specified setting
     *
     * @link https://apidocs.enhance.com/#/settings/getSetting
     * GET /settings/{name}
     *
     * @param string $name The name of the resource.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Setting|null
     */
    public function getSetting(?string $name): ?Setting
    {
        $response = $this->client->request(HttpMethod::GET, "/settings/{$name}");

        return $response->decoded !== null ? Setting::fromArray($response->decoded) : null;
    }

    /**
     * Create or update the specified setting
     *
     * @link https://apidocs.enhance.com/#/settings/updateSetting
     * PUT /settings/{name}
     *
     * @param string $name The name of the resource.
     * @param mixed $body
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateSetting(?string $name, mixed $body): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/settings/{$name}", [], $body);

        return $response->isSuccess;
    }

    /**
     * Remove the specified setting
     *
     * @link https://apidocs.enhance.com/#/settings/deleteSetting
     * DELETE /settings/{name}
     *
     * @param string $name The name of the resource.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteSetting(?string $name): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/settings/{$name}");

        return $response->isSuccess;
    }

    /**
     * Get the value for a particular global service setting
     *
     * Returns the value for a particular global service setting as a JSON object
     *
     * @link https://apidocs.enhance.com/#/settings/getGlobalServiceSetting
     * GET /settings/service/{setting_kind}
     *
     * @param SettingKind $settingKind The type of setting being applied
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return mixed
     */
    public function getGlobalServiceSetting(?SettingKind $settingKind): mixed
    {
        $response = $this->client->request(HttpMethod::GET, "/settings/service/{$settingKind->value}");

        return $response->decoded;
    }

    /**
     * Set a single global service setting
     *
     * Set or replace a single global service setting
     *
     * @link https://apidocs.enhance.com/#/settings/setGlobalServiceSetting
     * PUT /settings/service/{setting_kind}/{setting_key}
     *
     * @param SettingKind $settingKind The type of setting being applied
     * @param string $settingKey A key for updating an existing setting, some known values are - hard_delete_after_secs - letsencrypt_enabled - org_websites_same_server - screenshot_driver_pool_size - screenshot_interval - sged_smtp - smtp_smart_host - website_backup - default_dns_ttl
     * @param mixed $body
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Outcome|null
     */
    public function setGlobalServiceSetting(?SettingKind $settingKind, ?string $settingKey, mixed $body): ?Outcome
    {
        $response = $this->client->request(HttpMethod::PUT, "/settings/service/{$settingKind->value}/{$settingKey}", [], $body);

        return \is_string($response->decoded) || \is_int($response->decoded) ? Outcome::tryFrom($response->decoded) : null;
    }

    /**
     * Delete a single global service setting
     *
     * Delete a single global service setting value
     *
     * @link https://apidocs.enhance.com/#/settings/deleteGlobalServiceSetting
     * DELETE /settings/service/{setting_kind}/{setting_key}
     *
     * @param SettingKind $settingKind The type of setting being applied
     * @param string $settingKey A key for updating an existing setting, some known values are - hard_delete_after_secs - letsencrypt_enabled - org_websites_same_server - screenshot_driver_pool_size - screenshot_interval - sged_smtp - smtp_smart_host - website_backup - default_dns_ttl
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Outcome|null
     */
    public function deleteGlobalServiceSetting(?SettingKind $settingKind, ?string $settingKey): ?Outcome
    {
        $response = $this->client->request(HttpMethod::DELETE, "/settings/service/{$settingKind->value}/{$settingKey}");

        return \is_string($response->decoded) || \is_int($response->decoded) ? Outcome::tryFrom($response->decoded) : null;
    }

    /**
     * Get S3 object storage settings at platform level.
     *
     * @link https://apidocs.enhance.com/#/settings/getBackupRemoteStorageS3
     * GET /v2/settings/backup/remote_storage/s3
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return BackupRemoteStorageS3|null
     */
    public function getBackupRemoteStorageS3(): ?BackupRemoteStorageS3
    {
        $response = $this->client->request(HttpMethod::GET, '/v2/settings/backup/remote_storage/s3');

        return $response->decoded !== null ? BackupRemoteStorageS3::fromArray($response->decoded) : null;
    }

    /**
     * Create S3 object storage settings at platform level.
     *
     * @link https://apidocs.enhance.com/#/settings/createBackupRemoteStorageS3
     * POST /v2/settings/backup/remote_storage/s3
     *
     * @param CreateBackupRemoteStorageS3 $createBackupRemoteStorageS3
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function createBackupRemoteStorageS3(CreateBackupRemoteStorageS3 $createBackupRemoteStorageS3): bool
    {
        $response = $this->client->request(HttpMethod::POST, '/v2/settings/backup/remote_storage/s3', [], $createBackupRemoteStorageS3);

        return $response->isSuccess;
    }

    /**
     * Update S3 object storage settings at platform level.
     *
     * @link https://apidocs.enhance.com/#/settings/updateBackupRemoteStorageS3
     * PATCH /v2/settings/backup/remote_storage/s3
     *
     * @param UpdateBackupRemoteStorageS3 $updateBackupRemoteStorageS3
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateBackupRemoteStorageS3(UpdateBackupRemoteStorageS3 $updateBackupRemoteStorageS3): bool
    {
        $response = $this->client->request(HttpMethod::PATCH, '/v2/settings/backup/remote_storage/s3', [], $updateBackupRemoteStorageS3);

        return $response->isSuccess;
    }

    /**
     * Delete S3 object storage settings at platform level.
     *
     * @link https://apidocs.enhance.com/#/settings/deleteBackupRemoteStorageS3
     * DELETE /v2/settings/backup/remote_storage/s3
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteBackupRemoteStorageS3(): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, '/v2/settings/backup/remote_storage/s3');

        return $response->isSuccess;
    }

    /**
     * Get the demo mode status of the orchd service
     *
     * @link https://apidocs.enhance.com/#/settings/getDemoMode
     * GET /v2/settings/demo_mode
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return DemoMode|null
     */
    public function getDemoMode(): ?DemoMode
    {
        $response = $this->client->request(HttpMethod::GET, '/v2/settings/demo_mode');

        return $response->decoded !== null ? DemoMode::fromArray($response->decoded) : null;
    }
}
