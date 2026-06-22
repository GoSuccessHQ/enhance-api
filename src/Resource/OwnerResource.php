<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\OrgOwnerUpdate;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "owner" section of the Enhance API.
 */
final class OwnerResource extends AbstractResource
{
    /**
     * Update organization owner
     *
     * The new owner must already be a member in the organization before establishing ownership. This operation can only be done by a logged in superadmin of the organization's parent organization, or the owner of the organization. In both cases, the previous owner (if they existed) is demoted to SuperAdmin after this operation.
     *
     * @link https://apidocs.enhance.com/#/owner/updateOwner
     * PUT /orgs/{org_id}/owner
     *
     * @param OrgOwnerUpdate $orgOwnerUpdate Membership id of the to-be owner
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateOwner(OrgOwnerUpdate $orgOwnerUpdate, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/owner", [], $orgOwnerUpdate);

        return $response->isSuccess;
    }

    /**
     * Delete organization owner
     *
     * This operation can only be done by a logged in superadmin of the organization's parent organization (TODO it's unclear as of this writing whether organization owners may delete themselves). The previous owner is demoted to the "SupperAdmin" role.
     *
     * @link https://apidocs.enhance.com/#/owner/deleteOwner
     * DELETE /orgs/{org_id}/owner
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteOwner(?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/owner");

        return $response->isSuccess;
    }
}
