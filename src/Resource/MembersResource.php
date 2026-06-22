<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\Member;
use GoSuccess\Enhance\DTO\MembersListing;
use GoSuccess\Enhance\DTO\NewAccessToken;
use GoSuccess\Enhance\DTO\NewAccessTokenResponse;
use GoSuccess\Enhance\DTO\NewMember;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\OrgAccessToken;
use GoSuccess\Enhance\DTO\UpdateAccessToken;
use GoSuccess\Enhance\DTO\UpdateMember;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Enum\Role;

/**
 * Operations for the "members" section of the Enhance API.
 */
final class MembersResource extends AbstractResource
{
    /**
     * Get organization members
     *
     * Returns all (both pending and full) members of the organization.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/members/getMembers
     * GET /orgs/{org_id}/members
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param Role|null $role Return only members with this role.
     * @param string|null $siteAccess Return only collaborator members that have access to this website. Note that super admins and owners are not returned because they implicitly have access.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MembersListing|null
     */
    public function getMembers(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?Role $role = null,
        ?string $siteAccess = null,
        ?string $orgId = null,
    ): ?MembersListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'role' => $role,
            'siteAccess' => $siteAccess,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/members", $query);

        return $response->decoded !== null ? MembersListing::fromArray($response->decoded) : null;
    }

    /**
     * Create organization member
     *
     * A login for the member needs to exist before establishing membership. On success, the member id is returned. This operation can only be done by a logged in superadmin or owner of the organization or its parent organization(s).
     *
     * @link https://apidocs.enhance.com/#/members/createMember
     * POST /orgs/{org_id}/members
     *
     * @param NewMember $newMember New member details
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createMember(NewMember $newMember, ?string $orgId = null): ?NewResourceUuid
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/members", [], $newMember);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Get organization member
     *
     * Returns details about this organization member. This operation can only be done by the member itself, a logged in superadmin or owner of the organization or its parent organization(s).
     *
     * @link https://apidocs.enhance.com/#/members/getMember
     * GET /orgs/{org_id}/members/{member_id}
     *
     * @param string $memberId The id of the member.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Member|null
     */
    public function getMember(string $memberId, ?string $orgId = null): ?Member
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/members/{$memberId}");

        return $response->decoded !== null ? Member::fromArray($response->decoded) : null;
    }

    /**
     * Overwrite organization member settings
     *
     * Updates member information, such as their roles, site access permissions, and notification settings. This operation can only be done by the logged in superadmin or owner of the organization or its parent organization(s). This operation overwrites existing settings, so all existing values that are meant to be kept should be included in the response body.
     *
     * @link https://apidocs.enhance.com/#/members/updateMember
     * PUT /orgs/{org_id}/members/{member_id}
     *
     * @param string $memberId The id of the member.
     * @param UpdateMember $updateMember Member settings
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateMember(string $memberId, UpdateMember $updateMember, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PUT, "/orgs/{$orgId}/members/{$memberId}", [], $updateMember);

        return $response->isSuccess;
    }

    /**
     * Delete organization member
     *
     * This operation can only be done by a logged in superadmin or owner of the organization or its parent organization(s).
     *
     * @link https://apidocs.enhance.com/#/members/deleteMember
     * DELETE /orgs/{org_id}/members/{member_id}
     *
     * @param string $memberId The id of the member.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteMember(string $memberId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/members/{$memberId}");

        return $response->isSuccess;
    }

    /**
     * Get a One-Time-Password link for the member
     *
     * Returns a short lived one time password link for direct log-ins via the users realm. Session holder must be an `Owner`, `SuperAdmin` or `Sysadmin` in the org or the MO.
     *
     * @link https://apidocs.enhance.com/#/members/getOrgMemberLogin
     * GET /orgs/{org_id}/members/{member_id}/sso
     *
     * @param string $memberId The id of the member.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function getOrgMemberLogin(string $memberId, ?string $orgId = null): ?string
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/members/{$memberId}/sso");

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Get access token members
     *
     * Returns all access tokens belonging to the organisation
     *
     * @link https://apidocs.enhance.com/#/members/getAccessTokens
     * GET /orgs/{org_id}/access_tokens
     *
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return OrgAccessToken[]
     */
    public function getAccessTokens(?string $orgId = null): array
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/access_tokens");

        return array_map(static fn (array $item): OrgAccessToken => OrgAccessToken::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Create organisation access token
     *
     * Create an access token with rights within an organisation.
     *
     * @link https://apidocs.enhance.com/#/members/createAccessToken
     * POST /orgs/{org_id}/access_tokens
     *
     * @param NewAccessToken $newAccessToken Access token details
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewAccessTokenResponse|null
     */
    public function createAccessToken(NewAccessToken $newAccessToken, ?string $orgId = null): ?NewAccessTokenResponse
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/access_tokens", [], $newAccessToken);

        return $response->decoded !== null ? NewAccessTokenResponse::fromArray($response->decoded) : null;
    }

    /**
     * Update access token
     *
     * Update an access token
     *
     * @link https://apidocs.enhance.com/#/members/updateAccessToken
     * PATCH /orgs/{org_id}/access_tokens/{token_id}
     *
     * @param string $tokenId The id of an org access token.
     * @param UpdateAccessToken $updateAccessToken Access token details
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateAccessToken(
        string $tokenId,
        UpdateAccessToken $updateAccessToken,
        ?string $orgId = null,
    ): bool {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::PATCH, "/orgs/{$orgId}/access_tokens/{$tokenId}", [], $updateAccessToken);

        return $response->isSuccess;
    }

    /**
     * Delete access token member
     *
     * Delete an access token
     *
     * @link https://apidocs.enhance.com/#/members/deleteAccessToken
     * DELETE /orgs/{org_id}/access_tokens/{token_id}
     *
     * @param string $tokenId The id of an org access token.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteAccessToken(string $tokenId, ?string $orgId = null): bool
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::DELETE, "/orgs/{$orgId}/access_tokens/{$tokenId}");

        return $response->isSuccess;
    }
}
