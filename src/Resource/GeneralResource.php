<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\Enum\HttpMethod;

/**
 * Operations for the "general" section of the Enhance API.
 */
final class GeneralResource extends AbstractResource
{
    /**
     * Upload and restore a .tar.gz archive
     *
     * @link https://apidocs.enhance.com/#/general/uploadWebsiteBackup
     * POST /websites/{website_id}/backup/upload
     *
     * @param string $websiteId The id of the website.
     * @param string $contents Raw gzip payload.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return bool True on success
     */
    public function uploadWebsiteBackup(string $websiteId, string $contents): bool
    {
        $response = $this->client->request(HttpMethod::POST, "/websites/{$websiteId}/backup/upload", [], $contents, 'application/gzip');

        return $response->isSuccess;
    }
}
