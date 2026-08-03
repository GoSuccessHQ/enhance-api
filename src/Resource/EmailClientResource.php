<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\Autoresponder;
use GoSuccess\Enhance\DTO\EmailForwardersUpdate;
use GoSuccess\Enhance\DTO\EmailPasswordUpdate;
use GoSuccess\Enhance\DTO\EmailPublicIp;
use GoSuccess\Enhance\DTO\ForwardersFullListing;
use GoSuccess\Enhance\DTO\NewAutoresponder;
use GoSuccess\Enhance\DTO\NewResourceId;
use GoSuccess\Enhance\DTO\UpdateAutoresponder;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "email-client" section of the Enhance API.
 *
 * These endpoints act on behalf of a single mailbox rather than an
 * organization: on top of the configured access token, every one of them
 * requires the mailbox address and its current password, which are sent as the
 * `Address` and `Password` headers.
 */
final class EmailClientResource extends AbstractResource
{
    /**
     * Returns public Ip Address of the email server
     *
     * @link https://apidocs.enhance.com/#/email-client/GetEmailPublicIp
     * GET /email-client/public-ip
     *
     * @param string $address The email address to authenticate as.
     * @param string $password The current password of that email account.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return EmailPublicIp|null
     */
    public function GetEmailPublicIp(string $address, string $password): ?EmailPublicIp
    {
        $response = $this->client->request(HttpMethod::GET, '/email-client/public-ip', [], null, null, $this->credentials($address, $password));

        return \is_array($response->decoded) ? EmailPublicIp::fromArray($response->decoded) : null;
    }

    /**
     * Updates email account's password
     *
     * Accepts a new password in body. Client must send Authorization token, email address and its current password for authentication
     *
     * @link https://apidocs.enhance.com/#/email-client/UpdateEmailPassword
     * PUT /email-client/password
     *
     * @param EmailPasswordUpdate $emailPasswordUpdate
     * @param string $address The email address to authenticate as.
     * @param string $password The current password of that email account.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function UpdateEmailPassword(EmailPasswordUpdate $emailPasswordUpdate, string $address, string $password): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/email-client/password', [], $emailPasswordUpdate, null, $this->credentials($address, $password));

        return $response->isSuccess;
    }

    /**
     * Returns email account's forwarders
     *
     * Returns forwarders list for the given email account. Client must send Authorization token, email address and its current password for authentication
     *
     * @link https://apidocs.enhance.com/#/email-client/GetEmailForwarders
     * GET /email-client/forwarders
     *
     * @param string $address The email address to authenticate as.
     * @param string $password The current password of that email account.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ForwardersFullListing|null
     */
    public function GetEmailForwarders(string $address, string $password): ?ForwardersFullListing
    {
        $response = $this->client->request(HttpMethod::GET, '/email-client/forwarders', [], null, null, $this->credentials($address, $password));

        return \is_array($response->decoded) ? ForwardersFullListing::fromArray($response->decoded) : null;
    }

    /**
     * Updates email account's forwarders
     *
     * Accepts forwarders list in body. Client must send Authorization token, email address and its current password for authentication
     *
     * @link https://apidocs.enhance.com/#/email-client/UpdateEmailForwarders
     * PUT /email-client/forwarders
     *
     * @param EmailForwardersUpdate $emailForwardersUpdate
     * @param string $address The email address to authenticate as.
     * @param string $password The current password of that email account.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function UpdateEmailForwarders(EmailForwardersUpdate $emailForwardersUpdate, string $address, string $password): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/email-client/forwarders', [], $emailForwardersUpdate, null, $this->credentials($address, $password));

        return $response->isSuccess;
    }

    /**
     * Get email account autoresponder
     *
     * Returns autoresponders configured for the given email.
     * Client must send Authorization token, email address and its current password for authentication
     *
     * @link https://apidocs.enhance.com/#/email-client/getEmailAutoresponders
     * GET /email-client/autoresponders
     *
     * @param string $address The email address to authenticate as.
     * @param string $password The current password of that email account.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Autoresponder|null
     */
    public function getEmailAutoresponders(string $address, string $password): ?Autoresponder
    {
        $response = $this->client->request(HttpMethod::GET, '/email-client/autoresponders', [], null, null, $this->credentials($address, $password));

        return \is_array($response->decoded) ? Autoresponder::fromArray($response->decoded) : null;
    }

    /**
     * Create new email autoresponder
     *
     * Creates a new autoresponder for the given email.
     * Client must send Authorization token, email address and its current password for authentication
     *
     * @link https://apidocs.enhance.com/#/email-client/createEmailAutoresponder
     * POST /email-client/autoresponders
     *
     * @param NewAutoresponder $newAutoresponder Autoresponder details.
     * @param string $address The email address to authenticate as.
     * @param string $password The current password of that email account.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceId|null
     */
    public function createEmailAutoresponder(NewAutoresponder $newAutoresponder, string $address, string $password): ?NewResourceId
    {
        $response = $this->client->request(HttpMethod::POST, '/email-client/autoresponders', [], $newAutoresponder, null, $this->credentials($address, $password));

        return \is_array($response->decoded) ? NewResourceId::fromArray($response->decoded) : null;
    }

    /**
     * Update email autoresponder
     *
     * Updates the autoresponder belonging to the given email account.
     * Client must send Authorization token, email address and its current password for authentication
     *
     * @link https://apidocs.enhance.com/#/email-client/updateEmailAutoresponder
     * PUT /email-client/autoresponders/{autoresponder_id}
     *
     * @param string $autoresponderId
     * @param UpdateAutoresponder $updateAutoresponder Autoresponder update details.
     * @param string $address The email address to authenticate as.
     * @param string $password The current password of that email account.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateEmailAutoresponder(
        string $autoresponderId,
        UpdateAutoresponder $updateAutoresponder,
        string $address,
        string $password,
    ): bool {
        $response = $this->client->request(HttpMethod::PUT, "/email-client/autoresponders/{$autoresponderId}", [], $updateAutoresponder, null, $this->credentials($address, $password));

        return $response->isSuccess;
    }

    /**
     * Delete email autoresponder
     *
     * Deletes the autoresponder belonging to the given email account.
     * Client must send Authorization token, email address and its current
     *   password for authentication
     *
     * @link https://apidocs.enhance.com/#/email-client/deleteEmailAutoresponder
     * DELETE /email-client/autoresponders/{autoresponder_id}
     *
     * @param string $autoresponderId
     * @param string $address The email address to authenticate as.
     * @param string $password The current password of that email account.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteEmailAutoresponder(string $autoresponderId, string $address, string $password): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/email-client/autoresponders/{$autoresponderId}", [], null, null, $this->credentials($address, $password));

        return $response->isSuccess;
    }

    /**
     * Build the mailbox authentication headers required by every endpoint in
     * this section.
     *
     * @return array<string, string>
     */
    private function credentials(string $address, string $password): array
    {
        return ['Address' => $address, 'Password' => $password];
    }
}
