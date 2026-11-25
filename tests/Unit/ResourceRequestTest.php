<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Contract\HttpClientInterface;
use GoSuccess\Enhance\DTO\GitDeployInfo;
use GoSuccess\Enhance\DTO\ListedPersistentApp;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\NewWebsite;
use GoSuccess\Enhance\DTO\PersistentApp;
use GoSuccess\Enhance\DTO\ResourceSample;
use GoSuccess\Enhance\DTO\ResourceSampleIoDevice;
use GoSuccess\Enhance\DTO\WebsiteGithubConnection;
use GoSuccess\Enhance\DTO\WebsiteResourceUsageFullListing;
use GoSuccess\Enhance\Enhance;
use GoSuccess\Enhance\Enum\GitDeployState;
use GoSuccess\Enhance\Enum\GitDeployTrigger;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\WebsiteKind;
use GoSuccess\Enhance\Http\Response;
use GoSuccess\Enhance\Resource\PlansResource;
use GoSuccess\Enhance\Resource\ServersResource;
use GoSuccess\Enhance\Resource\WebsitesResource;
use PHPUnit\Framework\TestCase;

final class ResourceRequestTest extends TestCase
{
    public function testEntryPointWiresAllResources(): void
    {
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'org', 'token'), new SpyHttpClient());

        self::assertInstanceOf(WebsitesResource::class, $enhance->websites);
        self::assertInstanceOf(PlansResource::class, $enhance->plans);
        self::assertInstanceOf(ServersResource::class, $enhance->servers);
    }

    public function testCreateWebsiteBuildsRequestAndHydratesResponse(): void
    {
        $client = new SpyHttpClient(new Response(201, ['id' => 'uuid-1'], '{"id":"uuid-1"}'));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        $website = new NewWebsite();
        $website->domain = 'example.test';
        $website->phpVersion = PhpVersion::Php84;

        $result = $enhance->websites->createWebsite($website, WebsiteKind::Staging);

        self::assertInstanceOf(NewResourceUuid::class, $result);
        self::assertSame('uuid-1', $result->id);

        $call = $client->calls[0];
        self::assertSame(HttpMethod::POST, $call['method']);
        self::assertSame('/orgs/ORG-DEFAULT/websites', $call['endpoint']);
        self::assertSame(WebsiteKind::Staging, $call['query']['kind']);
        self::assertInstanceOf(NewWebsite::class, $call['body']);
        self::assertSame(['domain' => 'example.test', 'phpVersion' => 'php84'], $call['body']->jsonSerialize());
    }

    public function testOrgIdCanBeOverridden(): void
    {
        $client = new SpyHttpClient(new Response(200, ['items' => []], '{}'));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        $enhance->websites->getWebsites(orgId: 'OTHER-ORG');

        self::assertSame('/orgs/OTHER-ORG/websites', $client->calls[0]['endpoint']);
    }

    public function testAnOrgScopedEndpointRejectsAMissingOrgId(): void
    {
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', '', 'token'), new SpyHttpClient());

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('scoped to an organization');

        $enhance->websites->getWebsites();
    }

    public function testAnOrgLessEndpointWorksWithoutAnOrgId(): void
    {
        $client = new SpyHttpClient(new Response(200, '12.25.4', '"12.25.4"'));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', '', 'token'), $client);

        self::assertSame('12.25.4', $enhance->install->orchdVersion());
    }

    public function testAnExplicitOrgIdSatisfiesTheRequirement(): void
    {
        $client = new SpyHttpClient(new Response(200, ['items' => []], '{}'));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', '', 'token'), $client);

        $enhance->websites->getWebsites(orgId: 'OTHER-ORG');

        self::assertSame('/orgs/OTHER-ORG/websites', $client->calls[0]['endpoint']);
    }

    public function testOpenclawSsoReturnsTheRedirectTarget(): void
    {
        $client = new SpyHttpClient(new Response(302, null, '', ['location' => 'https://openclaw.example/sso?t=abc']));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        self::assertSame('https://openclaw.example/sso?t=abc', $enhance->apps->openclawSso('website-id'));
        self::assertSame('/websites/website-id/openclaw/sso', $client->calls[0]['endpoint']);
    }

    public function testSsoToRoundcubeReturnsTheRedirectTarget(): void
    {
        $client = new SpyHttpClient(new Response(302, null, '', ['location' => 'https://mail.example/sso?t=abc']));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        self::assertSame('https://mail.example/sso?t=abc', $enhance->emails->ssoToRoundcube('website-id', 'user@example.com'));
        self::assertSame('/orgs/ORG-DEFAULT/websites/website-id/emails/user@example.com/sso', $client->calls[0]['endpoint']);
    }

    public function testTheDeploymentLogComesBackAsText(): void
    {
        $client = new SpyHttpClient(new Response(200, 'npm" exited with code 1', "\"npm\" exited with code 1\n"));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        self::assertSame("\"npm\" exited with code 1\n", $enhance->websites->getWebsiteGitDeploymentLog('website-id', 'deploy-id'));
        self::assertSame('/orgs/ORG-DEFAULT/websites/website-id/git/deploys/deploy-id', $client->calls[0]['endpoint']);
    }

    public function testTheNodeVersionOfAPersistentAppIsAString(): void
    {
        self::assertSame('default', PersistentApp::fromArray(['nodeVersion' => 'default'])->nodeVersion);
        self::assertSame('22.11.0', ListedPersistentApp::fromArray(['nodeVersion' => '22.11.0'])->nodeVersion);
    }

    public function testScalarBodyIsSentVerbatim(): void
    {
        $client = new SpyHttpClient(new Response(200, null, ''));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        $enhance->websites->setContainerCronEnabledStatus('website-id', false);

        $call = $client->calls[0];
        self::assertSame(HttpMethod::PUT, $call['method']);
        self::assertSame('/websites/website-id/container_cron_enabled', $call['endpoint']);
        self::assertFalse($call['body']);
    }

    public function testEmailClientSendsMailboxCredentialsAsHeaders(): void
    {
        $client = new SpyHttpClient(new Response(200, ['ip' => '203.0.113.7'], '{}'));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        $enhance->emailClient->GetEmailPublicIp('info@example.test', 's3cret');

        self::assertSame(
            ['Address' => 'info@example.test', 'Password' => 's3cret'],
            $client->calls[0]['headers'],
        );
    }

    public function testBareBooleanResponseIsDecoded(): void
    {
        $client = new SpyHttpClient(new Response(200, false, 'false'));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        self::assertFalse($enhance->websites->getContainerCronEnabledStatus('website-id'));
    }

    public function testGitDeploysAreHydratedWithTheirEnums(): void
    {
        $payload = [[
            'deployId' => 'deploy-1',
            'state' => 'running',
            'timeStamp' => 1764000000,
            'branchOrTagName' => 'main',
            'repositoryName' => 'site',
            'commitMessage' => 'Release',
            'percentageComplete' => 40,
            'trigger' => 'automatic',
        ]];
        $client = new SpyHttpClient(new Response(200, $payload, (string)json_encode($payload)));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        $deploys = $enhance->websites->getWebsiteGitDeploys('website-id');

        self::assertSame('/orgs/ORG-DEFAULT/websites/website-id/git/deploys', $client->calls[0]['endpoint']);
        self::assertCount(1, $deploys);
        self::assertInstanceOf(GitDeployInfo::class, $deploys[0]);
        self::assertSame(GitDeployState::Running, $deploys[0]->state);
        self::assertSame(GitDeployTrigger::Automatic, $deploys[0]->trigger);
        self::assertSame(40.0, $deploys[0]->percentageComplete);
    }

    public function testConnectWebsiteGitSendsTheConnection(): void
    {
        $client = new SpyHttpClient(new Response(200, null, ''));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        $connection = new WebsiteGithubConnection();
        $connection->repoOwner = 'acme';
        $connection->repoName = 'site';
        $connection->branchOrTagName = 'main';
        $connection->autoDeploy = true;
        $connection->refKind = 'branch';

        self::assertTrue($enhance->websites->connectWebsiteGit('website-id', $connection));

        $call = $client->calls[0];
        self::assertSame(HttpMethod::PUT, $call['method']);
        self::assertSame('/orgs/ORG-DEFAULT/websites/website-id/git', $call['endpoint']);
        self::assertInstanceOf(WebsiteGithubConnection::class, $call['body']);
        self::assertSame(
            ['repoOwner' => 'acme', 'repoName' => 'site', 'branchOrTagName' => 'main', 'autoDeploy' => true, 'refKind' => 'branch'],
            $call['body']->jsonSerialize(),
        );
    }

    public function testResourceUsageSendsTheWindowAndHydratesTheSamples(): void
    {
        $payload = ['items' => [[
            'datetime' => 1764000000,
            'cpuUsec' => 123456789,
            'memoryBytes' => 1048576,
            'swapBytes' => 0,
            'pids' => 12,
            'ioDevices' => [['device' => '253:0', 'readBytes' => 1, 'writeBytes' => 2, 'readOps' => 3, 'writeOps' => 4, 'mountPoints' => ['/']]],
        ]]];
        $client = new SpyHttpClient(new Response(200, $payload, (string)json_encode($payload)));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        $usage = $enhance->resourceUsage->getWebsiteResourceUsage('website-id', start: '2026-11-23T00:00:00Z');

        $call = $client->calls[0];
        self::assertSame('/orgs/ORG-DEFAULT/websites/website-id/resource_usage', $call['endpoint']);
        self::assertSame('2026-11-23T00:00:00Z', $call['query']['start']);
        self::assertInstanceOf(WebsiteResourceUsageFullListing::class, $usage);
        self::assertNotNull($usage->items);
        $sample = $usage->items[0];
        self::assertInstanceOf(ResourceSample::class, $sample);
        self::assertSame(123456789, $sample->cpuUsec);
        self::assertNull($sample->memoryLimitBytes);
        self::assertNotNull($sample->ioDevices);
        self::assertInstanceOf(ResourceSampleIoDevice::class, $sample->ioDevices[0]);
        self::assertSame(['/'], $sample->ioDevices[0]->mountPoints);
    }

    public function testPossibleNodeVersionsAreAListOfStrings(): void
    {
        $client = new SpyHttpClient(new Response(200, ['v22.11.0', 'v24.1.0'], '["v22.11.0","v24.1.0"]'));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', '', 'token'), $client);

        self::assertSame(['v22.11.0', 'v24.1.0'], $enhance->apps->getGlobalPossibleNodeVersions());
        self::assertSame('/utils/possible_node_versions', $client->calls[0]['endpoint']);
    }

    public function testCreateMemberSessionReturnsTheToken(): void
    {
        $client = new SpyHttpClient(new Response(201, 'session-token', '"session-token"'));
        $enhance = new Enhance(new Configuration('https://cp.example.com/api', 'ORG-DEFAULT', 'token'), $client);

        self::assertSame('session-token', $enhance->members->createMemberSession('member-id'));
        self::assertSame(HttpMethod::POST, $client->calls[0]['method']);
        self::assertSame('/orgs/ORG-DEFAULT/members/member-id/session', $client->calls[0]['endpoint']);
    }
}

/**
 * Records the requests it receives and returns a canned response.
 */
final class SpyHttpClient implements HttpClientInterface
{
    /** @var list<array{method: HttpMethod, endpoint: string, query: array<string, mixed>, body: mixed, contentType: string|null, headers: array<string, string>}> */
    public array $calls = [];

    private Response $response;

    public function __construct(?Response $response = null)
    {
        $this->response = $response ?? new Response(200, [], '{}');
    }

    public function request(
        HttpMethod $method,
        string $endpoint,
        array $query = [],
        mixed $body = null,
        ?string $contentType = null,
        array $headers = [],
    ): Response {
        $this->calls[] = compact('method', 'endpoint', 'query', 'body', 'contentType', 'headers');

        return $this->response;
    }
}
