<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\Client\ApiClient;
use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

/**
 * Verifies the idempotency-aware retry policy.
 */
final class RetryPolicyTest extends TestCase
{
    /**
     * @return iterable<string, array{HttpMethod, ?int, ?string, bool}>
     */
    public static function cases(): iterable
    {
        // method, response status (null = transport error), curl error, expected retry
        yield 'GET on 500 retries' => [HttpMethod::GET, 500, null, true];
        yield 'PUT on 503 retries' => [HttpMethod::PUT, 503, null, true];
        yield 'DELETE on 500 retries' => [HttpMethod::DELETE, 500, null, true];
        yield 'POST on 500 does not retry' => [HttpMethod::POST, 500, null, false];
        yield 'PATCH on 502 does not retry' => [HttpMethod::PATCH, 502, null, false];
        yield 'POST on 429 retries' => [HttpMethod::POST, 429, null, true];
        yield 'PATCH on 429 retries' => [HttpMethod::PATCH, 429, null, true];
        yield 'GET transport error retries' => [HttpMethod::GET, null, 'timeout', true];
        yield 'POST transport error does not retry' => [HttpMethod::POST, null, 'timeout', false];
        yield 'GET on 400 does not retry' => [HttpMethod::GET, 400, null, false];
        yield 'POST on 201 does not retry' => [HttpMethod::POST, 201, null, false];
    }

    #[DataProvider('cases')]
    public function testRetryDecision(HttpMethod $method, ?int $status, ?string $curlError, bool $expected): void
    {
        $client = new ApiClient(new Configuration('https://example.test/api', 'org', 'token'));
        $response = $status === null ? null : new Response($status, null, '');

        $decision = new ReflectionMethod($client, 'shouldRetry');

        self::assertSame($expected, $decision->invoke($client, $method, $response, $curlError));
    }
}
