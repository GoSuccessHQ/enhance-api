<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Resource;

use GoSuccess\Enhance\Base\AbstractResource;
use GoSuccess\Enhance\DTO\MigrationDetails;
use GoSuccess\Enhance\DTO\MigrationLog;
use GoSuccess\Enhance\DTO\MigrationSessionCreationOk;
use GoSuccess\Enhance\DTO\MigrationSessionsListing;
use GoSuccess\Enhance\DTO\MigrationsListing;
use GoSuccess\Enhance\DTO\NewMigrationDetails;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Enum\MigrationStatus;

/**
 * Operations for the "migrations" section of the Enhance API.
 */
final class MigrationsResource extends AbstractResource
{
    /**
     * Get website role migrations
     *
     * Lists all server migrations, whether pending, in progress, failed or completed.
     *
     * @link https://apidocs.enhance.com/#/migrations/getMigrations
     * GET /migrations
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $searchDomain Look for a specific domain in the result set.
     * @param MigrationStatus|null $migrationStatus Filter by a particular migration status
     * @param string|null $sessionId Filter for a specific migration session.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MigrationsListing|null
     */
    public function getMigrations(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortOrder = null,
        ?string $sortBy = null,
        ?string $searchDomain = null,
        ?MigrationStatus $migrationStatus = null,
        ?string $sessionId = null,
    ): ?MigrationsListing {
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortOrder' => $sortOrder,
            'sortBy' => $sortBy,
            'searchDomain' => $searchDomain,
            'migrationStatus' => $migrationStatus,
            'sessionId' => $sessionId,
        ];
        $response = $this->client->request(HttpMethod::GET, '/migrations', $query);

        return \is_array($response->decoded) ? MigrationsListing::fromArray($response->decoded) : null;
    }

    /**
     * Create website role migration
     *
     * Create a new role website migration from one server to another. Deprecated in favor of createMigrationSession.
     *
     * @link https://apidocs.enhance.com/#/migrations/createMigration
     * POST /migrations
     *
     * @param NewMigrationDetails $newMigrationDetails Migration details.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return NewResourceUuid|null
     */
    public function createMigration(NewMigrationDetails $newMigrationDetails): ?NewResourceUuid
    {
        $response = $this->client->request(HttpMethod::POST, '/migrations', [], $newMigrationDetails);

        return \is_array($response->decoded) ? NewResourceUuid::fromArray($response->decoded) : null;
    }

    /**
     * Get a single migration
     *
     * Fetches the details of a single server migration.
     *
     * @link https://apidocs.enhance.com/#/migrations/getMigration
     * GET /migrations/{migrationId}
     *
     * @param string $migrationId The ID of the migration being acted upon.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MigrationDetails|null
     */
    public function getMigration(string $migrationId): ?MigrationDetails
    {
        $response = $this->client->request(HttpMethod::GET, "/migrations/{$migrationId}");

        return \is_array($response->decoded) ? MigrationDetails::fromArray($response->decoded) : null;
    }

    /**
     * Get the log for a migration
     *
     * Fetches the migration log for a single server migration.
     *
     * @link https://apidocs.enhance.com/#/migrations/getMigrationLog
     * GET /migrations/{migrationId}/log
     *
     * @param string $migrationId The ID of the migration being acted upon.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MigrationLog[]
     */
    public function getMigrationLog(string $migrationId): array
    {
        $response = $this->client->request(HttpMethod::GET, "/migrations/{$migrationId}/log");

        return array_map(static fn (array $item): MigrationLog => MigrationLog::fromArray($item), (array)($response->decoded ?? []));
    }

    /**
     * Get website role migration sessions
     *
     * Migration sessions group server migrations together under one id. This endpoint lists sessions, when were they created and when was any migration in the session last updated.
     * If searching by domain, the resulting migrationCount is the number of migrations in the session that match the search criteria.
     * If searching with createdBy, you can search by the email of the user who created the session. If the session was created with an API key, createdBy will be set to "via API". Legacy migrations created with deprecated "createMigration" endpoint are assigned under session that has createdBy set to "legacy migrations"
     *
     * @link https://apidocs.enhance.com/#/migrations/getMigrationSessions
     * GET /migrations/sessions
     *
     * @param int|null $offset The offset from which to return items.
     * @param int|null $limit The maximum number of items to return.
     * @param string|null $sortOrder The direction in which to sort. Possible values are 'asc' and 'desc', defaulting to 'asc'.
     * @param string|null $sortBy The field by which to sort.
     * @param string|null $createdBy Look for a specific session creator in the result set.
     * @param string|null $searchDomain Look for a specific domain in the result set.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MigrationSessionsListing|null
     */
    public function getMigrationSessions(
        ?int $offset = null,
        ?int $limit = null,
        ?string $sortOrder = null,
        ?string $sortBy = null,
        ?string $createdBy = null,
        ?string $searchDomain = null,
    ): ?MigrationSessionsListing {
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'sortOrder' => $sortOrder,
            'sortBy' => $sortBy,
            'createdBy' => $createdBy,
            'searchDomain' => $searchDomain,
        ];
        $response = $this->client->request(HttpMethod::GET, '/migrations/sessions', $query);

        return \is_array($response->decoded) ? MigrationSessionsListing::fromArray($response->decoded) : null;
    }

    /**
     * Create bulk website role migrations
     *
     * Create many new role website migration from one server to another. The migrations are grouped with a session id. If any migration fails to schedule, 206 is returned. If all migrations fail to schedule, 400 is returned. See the body for error messages in both cases.
     *
     * @link https://apidocs.enhance.com/#/migrations/createMigrationSession
     * POST /migrations/sessions
     *
     * @param array<int, mixed> $items Migrations details.
     * @throws \GoSuccess\Enhance\Exception\ApiException
     * @return MigrationSessionCreationOk|null
     */
    public function createMigrationSession(?array $items): ?MigrationSessionCreationOk
    {
        $response = $this->client->request(HttpMethod::POST, '/migrations/sessions', [], $items);

        return \is_array($response->decoded) ? MigrationSessionCreationOk::fromArray($response->decoded) : null;
    }
}
