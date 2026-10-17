<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\Client\ApiClient;
use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Enhance;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Exception\RequestException;
use GoSuccess\Enhance\Exception\ServerException;
use GoSuccess\Enhance\Exception\TransportException;
use GoSuccess\Enhance\Http\RawResponse;
use GoSuccess\Enhance\Http\Transport;
use PHPUnit\Framework\TestCase;

final class TransportTest extends TestCase
{
    /** @var list<array{method: HttpMethod, url: string, headers: list<string>, payload: string|array<string, mixed>|null}> */
    private array $sent = [];

    /** @var list<RawResponse|TransportException> */
    private array $answers = [];

    public function testARequestGoesThroughTheTransport(): void
    {
        $this->answers = [new RawResponse(200, ['content-type' => 'application/json'], '{"id":"o1"}')];

        $response = $this->client()->request(HttpMethod::POST, '/orgs/o1', ['limit' => 10], ['name' => 'x']);

        self::assertSame(['id' => 'o1'], $response->decoded);
        self::assertSame('{"id":"o1"}', $response->rawBody);
        self::assertSame(HttpMethod::POST, $this->sent[0]['method']);
        self::assertSame('https://panel.example/api/orgs/o1?limit=10', $this->sent[0]['url']);
        self::assertContains('Authorization: Bearer token', $this->sent[0]['headers']);
        self::assertContains('Content-Type: application/json', $this->sent[0]['headers']);
        self::assertSame('{"name":"x"}', $this->sent[0]['payload']);
    }

    public function testAServerErrorIsRetriedThroughTheTransport(): void
    {
        $this->answers = [new RawResponse(502, [], ''), new RawResponse(200, [], '"12.25.14"')];

        $response = $this->client(retries: 1)->request(HttpMethod::GET, '/version');

        self::assertCount(2, $this->sent);
        self::assertSame('12.25.14', $response->decoded);
    }

    public function testAnErrorStatusStillThrows(): void
    {
        $this->answers = [new RawResponse(503, [], '')];

        $this->expectException(ServerException::class);
        $this->client(retries: 0)->request(HttpMethod::GET, '/version');
    }

    public function testATransportFailureBecomesARequestException(): void
    {
        $this->answers = [new TransportException('connection refused'), new TransportException('connection refused')];

        try {
            $this->client(retries: 1)->request(HttpMethod::GET, '/version');
            self::fail('no exception');
        } catch (RequestException $e) {
            self::assertStringContainsString('connection refused', $e->getMessage());
        }

        self::assertCount(2, $this->sent, 'retried like a cURL error');
    }

    public function testEnhanceTakesTheTransport(): void
    {
        $this->answers = [new RawResponse(200, [], '"12.25.14"')];

        $enhance = new Enhance($this->configuration(0), transport: $this->transport());

        self::assertSame('12.25.14', $enhance->install->orchdVersion());
        self::assertSame('https://panel.example/api/version', $this->sent[0]['url']);
    }

    private function client(int $retries = 0): ApiClient
    {
        return new ApiClient($this->configuration($retries), $this->transport());
    }

    private function configuration(int $retries): Configuration
    {
        $config = new Configuration('https://panel.example/api', 'o1', 'token');
        $config->maxRetries = $retries;

        return $config;
    }

    private function transport(): Transport
    {
        return new class ($this) implements Transport {
            public function __construct(private TransportTest $test)
            {
            }

            public function send(HttpMethod $method, string $url, array $headers, string|array|null $payload, Configuration $config): RawResponse
            {
                return $this->test->record($method, $url, $headers, $payload);
            }
        };
    }

    /**
     * @param list<string> $headers
     * @param string|array<string, mixed>|null $payload
     */
    public function record(HttpMethod $method, string $url, array $headers, string|array|null $payload): RawResponse
    {
        $this->sent[] = ['method' => $method, 'url' => $url, 'headers' => $headers, 'payload' => $payload];
        $answer = array_shift($this->answers) ?? new RawResponse(500, [], '');

        if ($answer instanceof TransportException) {
            throw $answer;
        }

        return $answer;
    }
}
