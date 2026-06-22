<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Contract\HttpClientInterface;
use GoSuccess\Enhance\DTO\NewResourceUuid;
use GoSuccess\Enhance\DTO\NewWebsite;
use GoSuccess\Enhance\Enhance;
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
}

/**
 * Records the requests it receives and returns a canned response.
 */
final class SpyHttpClient implements HttpClientInterface
{
    /** @var list<array{method: HttpMethod, endpoint: string, query: array<string, mixed>, body: mixed, contentType: string|null}> */
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
    ): Response {
        $this->calls[] = compact('method', 'endpoint', 'query', 'body', 'contentType');

        return $this->response;
    }
}
