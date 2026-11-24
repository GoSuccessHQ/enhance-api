<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\WebsiteResourceUsageFullListing;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "resource_usage" section of the Enhance API.
 */
final class ResourceUsageResource extends AbstractResource
{
    /**
     * Get website resource usage
     *
     * Returns cgroup resource usage samples (CPU, memory, swap, disk IO bandwidth, IOPS, PIDs) between the optional start and end date.
     * The data is downsampled onto a uniform grid whose bucket width grows with the requested window; windows of an hour or less keep every stored sample.
     * Defaults to the full retention window (30 days); start is clamped to the retention window and end to now.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/resource_usage/getWebsiteResourceUsage
     * GET /orgs/{org_id}/websites/{website_id}/resource_usage
     *
     * @param string $websiteId The id of the website.
     * @param string|null $start Start datetime UTC.
     * @param string|null $end End datetime UTC.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsiteResourceUsageFullListing|null
     */
    public function getWebsiteResourceUsage(
        string $websiteId,
        ?string $start = null,
        ?string $end = null,
        ?string $orgId = null,
    ): ?WebsiteResourceUsageFullListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'start' => $start,
            'end' => $end,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/resource_usage", $query);

        return \is_array($response->decoded) ? WebsiteResourceUsageFullListing::fromArray($response->decoded) : null;
    }
}
