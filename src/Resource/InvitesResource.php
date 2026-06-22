<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\AcceptInviteBody;
use GoSuccess\Enhance\DTO\InviteValidation;
use GoSuccess\Enhance\DTO\NewInvite;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "invites" section of the Enhance API.
 */
final class InvitesResource extends AbstractResource
{
    /**
     * Create invite
     *
     * Issues an invite for the user with the given email.
     * The user may or may not have an account in the realm that the organization is in: If the user is not registered yet, a pending login entry is created for them along with a pending member entry, and the login is "activated" once the user accepts the invite. In this case they need to supply a password. If the user is already registered, their existing login is linked to a pending member entry that gets "activated" once the user accepts the invite.
     * The sent out invite contains the following URL: http://{control_panel_domain}/invites/{invite_key}?email={user_email}
     * The invite is also returned as a string response for immediate display to the creator of the invite.
     * Where control panel domain is the domain name of the reseller's or the MO's control panel, the invite key is randomly generated, and the user email is the email address to which the invite is sent (and can be used by the API consumer e.g. for display purposes).
     * If the invite is issued for the same organization and email more than once, the invite email is simply sent out again, with a different invite token.
     * The routine will fail if the login already has membership in the organization.
     * Session holder must be at least a `SuperAdmin` in this org or a parent org.
     *
     * @link https://apidocs.enhance.com/#/invites/createInvite
     * POST /orgs/{org_id}/invites
     *
     * @param NewInvite $newInvite Invite details.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return string|null
     */
    public function createInvite(NewInvite $newInvite, ?string $orgId = null): ?string
    {
        $orgId = $this->orgId($orgId);
        $response = $this->client->request(HttpMethod::POST, "/orgs/{$orgId}/invites", [], $newInvite);

        return $response->decoded === null ? null : (string)$response->decoded;
    }

    /**
     * Accept invite
     *
     * Accepts the invite.
     * There are four cases that need to be handled:
     * No login session is present, user is newly invited and does not yet have a password. The password submitted in the body is set on the new user and the login's member is marked as active within the organization. A session is created and set in the returned cookie.
     * No login session is present but user already exists and has a password. The password submitted in the request body is used to validate the login and the login's member is marked as active within the organization. A session is created and set in the returned cookie.
     * A login session is present for the user to whom the invite belongs. The user is marked active within the organisation to which it was invited.
     * A login session is present for a login to whom the invite does not belong, resulting in an error.
     *
     * @link https://apidocs.enhance.com/#/invites/acceptInvite
     * POST /invites/{invite_id}
     *
     * @param string $inviteId The id of the invite.
     * @param AcceptInviteBody $acceptInviteBody Login credentials.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function acceptInvite(string $inviteId, ?AcceptInviteBody $acceptInviteBody = null): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/invites/{$inviteId}", [], $acceptInviteBody);

        return $response->isSuccess;
    }

    /**
     * Validate invite
     *
     * Validates the invite.
     * If successful, it returns the invite details: the organization's id and name, and the to-be-member's role.
     * No session required.
     *
     * @link https://apidocs.enhance.com/#/invites/validateInvite
     * POST /invites/{invite_id}/validate
     *
     * @param string $inviteId The id of the invite.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return InviteValidation|null
     */
    public function validateInvite(string $inviteId): ?InviteValidation
    {
        $response = $this->client->request(HttpMethod::POST, "/invites/{$inviteId}/validate");

        return $response->decoded !== null ? InviteValidation::fromArray($response->decoded) : null;
    }
}
