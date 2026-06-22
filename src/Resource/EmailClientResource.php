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
 */
final class EmailClientResource extends AbstractResource
{
    /**
     * Returns public Ip Address of the email server
     *
     * @link https://apidocs.enhance.com/#/email-client/GetEmailPublicIp
     * GET /email-client/public-ip
     *
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return EmailPublicIp|null
     */
    public function GetEmailPublicIp(): ?EmailPublicIp
    {
        $response = $this->client->request(HttpMethod::GET, '/email-client/public-ip');

        return $response->decoded !== null ? EmailPublicIp::fromArray($response->decoded) : null;
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
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function UpdateEmailPassword(EmailPasswordUpdate $emailPasswordUpdate): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/email-client/password', [], $emailPasswordUpdate);

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
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return ForwardersFullListing|null
     */
    public function GetEmailForwarders(): ?ForwardersFullListing
    {
        $response = $this->client->request(HttpMethod::GET, '/email-client/forwarders');

        return $response->decoded !== null ? ForwardersFullListing::fromArray($response->decoded) : null;
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
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function UpdateEmailForwarders(EmailForwardersUpdate $emailForwardersUpdate): bool
    {
        $response = $this->client->request(HttpMethod::PUT, '/email-client/forwarders', [], $emailForwardersUpdate);

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
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return Autoresponder|null
     */
    public function getEmailAutoresponders(): ?Autoresponder
    {
        $response = $this->client->request(HttpMethod::GET, '/email-client/autoresponders');

        return $response->decoded !== null ? Autoresponder::fromArray($response->decoded) : null;
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
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceId|null
     */
    public function createEmailAutoresponder(NewAutoresponder $newAutoresponder): ?NewResourceId
    {
        $response = $this->client->request(HttpMethod::POST, '/email-client/autoresponders', [], $newAutoresponder);

        return $response->decoded !== null ? NewResourceId::fromArray($response->decoded) : null;
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
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function updateEmailAutoresponder(string $autoresponderId, UpdateAutoresponder $updateAutoresponder): bool
    {
        $response = $this->client->request(HttpMethod::PUT, "/email-client/autoresponders/{$autoresponderId}", [], $updateAutoresponder);

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
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function deleteEmailAutoresponder(string $autoresponderId): bool
    {
        $response = $this->client->request(HttpMethod::DELETE, "/email-client/autoresponders/{$autoresponderId}");

        return $response->isSuccess;
    }
}
