<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\Client\ApiClient;
use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Exception\ApiException;
use GoSuccess\Enhance\Exception\NotFoundException;
use GoSuccess\Enhance\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

/**
 * Verifies how the client classifies response status codes.
 */
final class ResponseHandlingTest extends TestCase
{
    public function testRedirectExposesItsLocation(): void
    {
        $response = new Response(302, null, '', ['location' => 'https://cp.example.com/sso?token=abc']);

        self::assertFalse($response->isSuccess);
        self::assertTrue($response->isRedirect);
        self::assertSame('https://cp.example.com/sso?token=abc', $response->location);
    }

    public function testLocationIsNullWithoutTheHeader(): void
    {
        self::assertNull(new Response(302, null, '')->location);
    }

    /**
     * @return iterable<string, array{int}>
     */
    public static function passedThroughStatuses(): iterable
    {
        yield '200 is returned' => [200];
        yield '204 is returned' => [204];
        // The SSO endpoints document a redirect as their success case.
        yield '302 is returned' => [302];
        yield '307 is returned' => [307];
    }

    #[DataProvider('passedThroughStatuses')]
    public function testSuccessAndRedirectAreReturned(int $status): void
    {
        $response = new Response($status, null, '');

        self::assertSame($response, $this->handle($response));
    }

    public function testClientErrorStillThrows(): void
    {
        $this->expectException(NotFoundException::class);

        $this->handle(new Response(404, ['message' => 'nope'], '{"message":"nope"}'));
    }

    public function testUnmappedStatusThrowsTheBaseException(): void
    {
        $this->expectException(ApiException::class);

        $this->handle(new Response(418, null, ''));
    }

    public function testExtraHeadersAreAppendedToTheDefaults(): void
    {
        self::assertSame(
            [
                'Accept: application/json',
                'Authorization: Bearer token',
                'User-Agent: agent',
                'Address: info@example.test',
                'Password: s3cret',
            ],
            $this->buildHeaders(['Address' => 'info@example.test', 'Password' => 's3cret']),
        );
    }

    public function testExtraHeadersReplaceADefaultRegardlessOfCase(): void
    {
        self::assertSame(
            [
                'Accept: application/json',
                'authorization: Bearer other',
                'User-Agent: agent',
            ],
            $this->buildHeaders(['authorization' => 'Bearer other']),
        );
    }

    /**
     * @param array<string, string> $extraHeaders
     * @return list<string>
     */
    private function buildHeaders(array $extraHeaders): array
    {
        $config = new Configuration('https://example.test/api', 'org', 'token');
        $config->userAgent = 'agent';

        /** @var list<string> */
        return new ReflectionMethod(ApiClient::class, 'buildHeaders')->invoke(new ApiClient($config), $extraHeaders);
    }

    private function handle(Response $response): Response
    {
        $client = new ApiClient(new Configuration('https://example.test/api', 'org', 'token'));

        /** @var Response */
        return new ReflectionMethod($client, 'handle')->invoke($client, $response);
    }
}
