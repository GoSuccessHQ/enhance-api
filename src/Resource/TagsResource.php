<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\NewResourceId;
use GoSuccess\Enhance\DTO\NewTag;
use GoSuccess\Enhance\DTO\TagsFullListing;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "tags" section of the Enhance API.
 */
final class TagsResource extends AbstractResource
{
    /**
     * Get tags
     *
     * Returns all tags belonging to the organization.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/tags/getTags
     * GET /orgs/{org_id}/tags
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return TagsFullListing|null
     */
    public function getTags(?string $orgId = null): ?TagsFullListing
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/tags");

        return $response->decoded !== null ? TagsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create tag
     *
     * Creates a new tag for the organization.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/tags/createTag
     * POST /orgs/{org_id}/tags
     *
     * @param NewTag $newTag New tag details
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceId|null
     */
    public function createTag(NewTag $newTag, ?string $orgId = null): ?NewResourceId
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/tags", [], $newTag);

        return $response->decoded !== null ? NewResourceId::fromArray($response->decoded) : null;
    }
}
