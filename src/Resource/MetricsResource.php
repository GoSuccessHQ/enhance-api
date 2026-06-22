<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\WebsiteMetricsFullListing;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "metrics" section of the Enhance API.
 */
final class MetricsResource extends AbstractResource
{
    /**
     * Get website metrics
     *
     * Returns website metrics between the optional start and end date. Defaults to last 24 hours.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org, or be a member in this org that has access to the website.
     *
     * @link https://apidocs.enhance.com/#/metrics/getWebsiteMetrics
     * GET /orgs/{org_id}/websites/{website_id}/metrics
     *
     * @param string $websiteId The id of the website.
     * @param string|null $start Start datetime UTC.
     * @param string|null $end End datetime UTC.
     * @param string|null $granularity Takes one of `hour`, `day`, defaults to `day`
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return WebsiteMetricsFullListing|null
     */
    public function getWebsiteMetrics(
        string $websiteId,
        ?string $start = null,
        ?string $end = null,
        ?string $granularity = null,
        ?string $orgId = null,
    ): ?WebsiteMetricsFullListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'start' => $start,
            'end' => $end,
            'granularity' => $granularity,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/websites/{$websiteId}/metrics", $query);

        return $response->decoded !== null ? WebsiteMetricsFullListing::fromArray($response->decoded) : null;
    }
}
