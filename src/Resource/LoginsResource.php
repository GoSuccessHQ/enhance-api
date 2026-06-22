<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\EmailAddress;
use GoSuccess\Enhance\DTO\Login;
use GoSuccess\Enhance\DTO\Login2FA;
use GoSuccess\Enhance\DTO\LoginCreds;
use GoSuccess\Enhance\DTO\LoginInfo;
use GoSuccess\Enhance\DTO\LoginMemberships;
use GoSuccess\Enhance\DTO\LoginsListing;
use GoSuccess\Enhance\DTO\NewPassword;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\NewUiPreferences;
use GoSuccess\Enhance\DTO\ResendPin;
use GoSuccess\Enhance\DTO\SessionsFullListing;
use GoSuccess\Enhance\DTO\UiPreferences;
use GoSuccess\Enhance\DTO\UpdateLogin;
use GoSuccess\Enhance\DTO\UpdateLoginResult;
use GoSuccess\Enhance\DTO\UpdateUiPreferences;
use GoSuccess\Enhance\DTO\ValidatedPasswordRecovery;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "logins" section of the Enhance API.
 */
final class LoginsResource extends AbstractResource
{
    /**
     * Query all logins
     *
     * Returns all logins registered in the control panel.
     * Session holder must be an `Owner`, `SuperAdmin`, or `Sysadmin` in the MO.
     *
     * @link https://apidocs.enhance.com/#/logins/getLogins
     * GET /logins
     *
     * @param string|null $realmId The id of the realm to query. Realm ids map to org ids.
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $sortBy The field by which to sort.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LoginsListing|null
     */
    public function getLogins(
        ?string $realmId = null,
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortOrder = null,
        ?string $sortBy = null,
    ): ?LoginsListing {
        $query = [
            'realmId' => $realmId,
            'offset' => $offset,
            'limit' => $limit,
            'sortOrder' => $sortOrder,
            'sortBy' => $sortBy,
        ];
        $response = $this->client->request(HttpMethod::GET, '/logins', $query);

        return $response->decoded !== null ? LoginsListing::fromArray($response->decoded) : null;
    }

    /**
     * Create a new login
     *
     * Creates a login in the realm.
     * The login will be created in the same realm that the organization is in.
     * Session holder must have admin or support privileges in the given organization or any parent thereof.
     *
     * @link https://apidocs.enhance.com/#/logins/createLogin
     * POST /logins
     *
     * @param LoginInfo $loginInfo
     * @param string|null $orgId The mandatory organization id to denote in which realm to create the login in. The login will be created in the same realm that the organization is in.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createLogin(LoginInfo $loginInfo, ?string $orgId = null): ?NewResourceUuid
    {
        $query = [
            'orgId' => $orgId,
        ];
        $response = $this->client->request(HttpMethod::POST, '/logins', $query, $loginInfo);

        return $response->decoded !== null ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Get all login sessions
     *
     * @link https://apidocs.enhance.com/#/logins/getSessions
     * GET /login/sessions
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return SessionsFullListing|null
     */
    public function getSessions(): ?SessionsFullListing
    {
        $response = $this->client->request(HttpMethod::GET, '/login/sessions');

        return $response->decoded !== null ? SessionsFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Create a new session for login
     *
     * Creates a new session for the login in a specific login realm.
     * By default, the realm in which to look up a given login is dictated by the domain on which the request is made.  If it matches a mapped to a ControlPanel website belonging to an MO or a reseller then that MO or reseller is used as the relam from which to select the login.  If the login exists directly as a member of the chosen realm then that login will be selected in preference to any which exists within the realm itself.
     * The realm derived from the control panel domain can be overridden with the realmId parameter to specify a particular reseller or the MO.
     * The authentication result is a JWT session token and a list detailing the organizations in which login is a member.
     * In case of 2FA, the authentication result is a JWT session token with empty body and 201 http status code.
     *
     * @link https://apidocs.enhance.com/#/logins/createSession
     * POST /login/sessions
     *
     * @param LoginCreds $loginCreds Login credentials.
     * @param string|null $realmId If set with the given realm's id (the parent id of an organization), then the login is authenticated in this realm. See the endpoint description for more info.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LoginMemberships|null
     */
    public function createSession(LoginCreds $loginCreds, ?string $realmId = null): ?LoginMemberships
    {
        $query = [
            'realmId' => $realmId,
        ];
        $response = $this->client->request(HttpMethod::POST, '/login/sessions', $query, $loginCreds);

        return $response->decoded !== null ? LoginMemberships::fromArray($response->decoded) : null;
    }

    /**
     * Delete sessions
     *
     * @link https://apidocs.enhance.com/#/logins/deleteSessions
     * DELETE /login/sessions
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteSessions(): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, '/login/sessions');

        return $response->isSuccess;
    }

    /**
     * Delete current session
     *
     * @link https://apidocs.enhance.com/#/logins/deleteCurrentSession
     * DELETE /login/sessions/current
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteCurrentSession(): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, '/login/sessions/current');

        return $response->isSuccess;
    }

    /**
     * Create a new session for login with a one-time-password
     *
     * Creates a new session for the login in a specific login realm, using a short lived one time password.
     * This creates a session as well, with the difference that realmId is required and any 2FA will be bypassed.
     *
     * @link https://apidocs.enhance.com/#/logins/createOtpSession
     * GET /login/sessions/sso
     *
     * @param string|null $otp Contains a short lived otp for direct login bypassing any 2FA.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LoginMemberships|null
     */
    public function createOtpSession(?string $otp = null): ?LoginMemberships
    {
        $query = [
            'otp' => $otp,
        ];
        $response = $this->client->request(HttpMethod::GET, '/login/sessions/sso', $query);

        return $response->decoded !== null ? LoginMemberships::fromArray($response->decoded) : null;
    }

    /**
     * Delete current session
     *
     * @link https://apidocs.enhance.com/#/logins/deleteSession
     * DELETE /login/sessions/{session_id}
     *
     * @param string $sessionId The id of the login session.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteSession(string $sessionId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/login/sessions/{$sessionId}");

        return $response->isSuccess;
    }

    /**
     * Verifies 2FA sign-in code.
     *
     * On success, standard session with cookie is returned, otherwise 401 Unauthorized is returned with an empty cookie and the session is removed.
     * Note that 2FA can only be used with the session cookie.
     *
     * @link https://apidocs.enhance.com/#/logins/verify2FA
     * POST /login/2fa
     *
     * @param Login2FA $login2FA Verification details.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function verify2FA(Login2FA $login2FA): bool
    {
        $response = $this->client->request(HttpMethod::POST, '/login/2fa', [], $login2FA);

        return $response->isSuccess;
    }

    /**
     * Resends 2FA sign-in code.
     *
     * On success, standard session with a new pin returned, otherwise 401 Unauthorized is returned with an empty cookie and the session is removed.
     * Note that 2FA can only be used with the session cookie.
     *
     * @link https://apidocs.enhance.com/#/logins/resendPin
     * POST /login/2fa/resend-pin
     *
     * @param ResendPin $resendPin Verification details.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function resendPin(ResendPin $resendPin): bool
    {
        $response = $this->client->request(HttpMethod::POST, '/login/2fa/resend-pin', [], $resendPin);

        return $response->isSuccess;
    }

    /**
     * Finish a password recovery
     *
     * Finishes the password recovery for the recovery key.
     * This operation only succeeds if the key hasn't expired. If it has, the user must initiate a new password recovery.
     *
     * @link https://apidocs.enhance.com/#/logins/finishPasswordRecovery
     * POST /login/password-recovery
     *
     * @param NewPassword $newPassword Login's new password.
     * @param string|null $secret The secret key for the password recovery.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function finishPasswordRecovery(NewPassword $newPassword, ?string $secret = null): bool
    {
        $query = [
            'secret' => $secret,
        ];
        $response = $this->client->request(HttpMethod::POST, '/login/password-recovery', $query, $newPassword);

        return $response->isSuccess;
    }

    /**
     * Start a new password recovery for login
     *
     * Initiates a new password recovery for the given email address, or fails silently (returning a `200 Ok`) if no login corresponded to the email.
     * Note that only logins who are registered may initiate a password recovery. Users who were invited by an org member and haven't finished their signup may not start a recovery.
     *
     * @link https://apidocs.enhance.com/#/logins/startPasswordRecovery
     * PUT /login/password-recovery
     *
     * @param EmailAddress $emailAddress Login's email address.
     * @param string|null $realmId If set, the login is looked up in the specified realm. If unset then the chosen realm will be based on the control panel hostname.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function startPasswordRecovery(EmailAddress $emailAddress, ?string $realmId = null): bool
    {
        $query = [
            'realmId' => $realmId,
        ];
        $response = $this->client->request(HttpMethod::PUT, '/login/password-recovery', $query, $emailAddress);

        return $response->isSuccess;
    }

    /**
     * Validate a password recovery secret
     *
     * Returns the obfuscated email address belonging to the user initiating the password recovery if the secret is correct and hasn't expired yet.
     *
     * @link https://apidocs.enhance.com/#/logins/validatePasswordRecovery
     * POST /login/password-recovery/validate
     *
     * @param string|null $secret The secret key for the password recovery.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ValidatedPasswordRecovery|null
     */
    public function validatePasswordRecovery(?string $secret = null): ?ValidatedPasswordRecovery
    {
        $query = [
            'secret' => $secret,
        ];
        $response = $this->client->request(HttpMethod::POST, '/login/password-recovery/validate', $query);

        return $response->decoded !== null ? ValidatedPasswordRecovery::fromArray($response->decoded) : null;
    }

    /**
     * Get login memberships
     *
     * Returns a list of info about all organization's the login is a member of. The return value is the same as that of successful session creation.
     *
     * @link https://apidocs.enhance.com/#/logins/getLoginMemberships
     * GET /login/memberships
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LoginMemberships|null
     */
    public function getLoginMemberships(): ?LoginMemberships
    {
        $response = $this->client->request(HttpMethod::GET, '/login/memberships');

        return $response->decoded !== null ? LoginMemberships::fromArray($response->decoded) : null;
    }

    /**
     * Get login info
     *
     * @link https://apidocs.enhance.com/#/logins/getLogin
     * GET /login
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Login|null
     */
    public function getLogin(): ?Login
    {
        $response = $this->client->request(HttpMethod::GET, '/login');

        return $response->decoded !== null ? Login::fromArray($response->decoded) : null;
    }

    /**
     * Update login info
     *
     * Updates some or all login information and credentials.
     * Only the currently authenticated login may do this (thus there is no explicit login id in the input).
     * If the email or password are to be updated, the current password must be provided.
     * In order to disable MFA, a user has to validate the PIN code required by the enabled method. If users want to switch to a different MFA method, they need to disable MFA and enable the desired MFA method.
     *
     * @link https://apidocs.enhance.com/#/logins/updateLoginInfo
     * PATCH /login
     *
     * @param UpdateLogin $updateLogin
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return UpdateLoginResult|null
     */
    public function updateLoginInfo(UpdateLogin $updateLogin): ?UpdateLoginResult
    {
        $response = $this->client->request(HttpMethod::PATCH, '/login', [], $updateLogin);

        return $response->decoded !== null ? UpdateLoginResult::fromArray($response->decoded) : null;
    }

    /**
     * Set login avatar
     *
     * Sets the user's avatar, overwriting any previous one if one exists.
     * The max allowed size is 200 KiB. The image format may be jpeg, png, and ico.
     * The user is implicitly assumed to be the session holder, so no login id is supplied.
     *
     * @link https://apidocs.enhance.com/#/logins/setLoginAvatar
     * PUT /login/avatar
     *
     * @param array<string, mixed> $formData Multipart form fields.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setLoginAvatar(?array $formData = null): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/login/avatar', [], $formData, 'multipart/form-data');

        return $response->isSuccess;
    }

    /**
     * Remove login avatar
     *
     * Deletes the user's avatar.
     * The user is implicitly assumed to be the session holder, so no login id is supplied.
     *
     * @link https://apidocs.enhance.com/#/logins/deleteLoginAvatar
     * DELETE /login/avatar
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteLoginAvatar(): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, '/login/avatar');

        return $response->isSuccess;
    }

    /**
     * Query logins belonging to organization
     *
     * Returns all logins registered in given organization.
     * Session holder must be an `Owner`, `SuperAdmin` or `Sysadmin` in the org or the MO.
     *
     * @link https://apidocs.enhance.com/#/logins/getOrgLogins
     * GET /orgs/{org_id}/logins
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LoginsListing|null
     */
    public function getOrgLogins(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortOrder = null,
        ?string $sortBy = null,
        ?string $orgId = null,
    ): ?LoginsListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortOrder' => $sortOrder,
            'sortBy' => $sortBy,
        ];
        $response = $this->client->request(HttpMethod::GET, "/orgs/{$orgId}/logins", $query);

        return $response->decoded !== null ? LoginsListing::fromArray($response->decoded) : null;
    }

    /**
     * List customer logins for org
     *
     * @link https://apidocs.enhance.com/#/logins/getCustomerLogins
     * GET /v2/orgs/{org_id}/customers/logins
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $orgId Organization id (defaults to the configured organization)
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return LoginsListing|null
     */
    public function getCustomerLogins(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortOrder = null,
        ?string $sortBy = null,
        ?string $orgId = null,
    ): ?LoginsListing {
        $orgId = $this->orgId($orgId);
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortOrder' => $sortOrder,
            'sortBy' => $sortBy,
        ];
        $response = $this->client->request(HttpMethod::GET, "/v2/orgs/{$orgId}/customers/logins", $query);

        return $response->decoded !== null ? LoginsListing::fromArray($response->decoded) : null;
    }

    /**
     * Set password for login
     *
     * This operation allows admins to reset the password for a login.
     *
     * @link https://apidocs.enhance.com/#/logins/setCustomerLoginPassword
     * PUT /v2/logins/{login_id}/password
     *
     * @param string $loginId The id of a login.
     * @param NewPassword $newPassword The new unhashed password to set for the login
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setCustomerLoginPassword(string $loginId, NewPassword $newPassword): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/v2/logins/{$loginId}/password", [], $newPassword);

        return $response->isSuccess;
    }

    /**
     * Get UI prefereces for login
     *
     * The operation allows users to get UI prefereces.
     *
     * @link https://apidocs.enhance.com/#/logins/getUiPreferences
     * GET /logins/ui-preferences
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return UiPreferences|null
     */
    public function getUiPreferences(): ?UiPreferences
    {
        $response = $this->client->request(HttpMethod::GET, '/logins/ui-preferences');

        return $response->decoded !== null ? UiPreferences::fromArray($response->decoded) : null;
    }

    /**
     * Set new UI prefereces for login
     *
     * The operation allows users to set a new UI prefereces.
     *
     * @link https://apidocs.enhance.com/#/logins/setUiPreferences
     * POST /logins/ui-preferences
     *
     * @param NewUiPreferences $newUiPreferences
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function setUiPreferences(NewUiPreferences $newUiPreferences): bool
    {
        $response = $this->client->request(HttpMethod::POST, '/logins/ui-preferences', [], $newUiPreferences);

        return $response->isSuccess;
    }

    /**
     * Update UI prefereces for login
     *
     * The operation allows users to update UI prefereces.
     *
     * @link https://apidocs.enhance.com/#/logins/updateUiPreferences
     * PATCH /logins/ui-preferences
     *
     * @param UpdateUiPreferences $updateUiPreferences
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateUiPreferences(UpdateUiPreferences $updateUiPreferences): bool
    {
        $response = $this->client->request(HttpMethod::PATCH, '/logins/ui-preferences', [], $updateUiPreferences);

        return $response->isSuccess;
    }
}
