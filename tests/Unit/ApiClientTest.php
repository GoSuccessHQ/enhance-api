<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\Client\ApiClient;
use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\ServerRole;
use GoSuccess\Enhance\Http\CurlTransport;
use GoSuccess\Enhance\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

/**
 * Covers the request and response plumbing of the cURL client: everything
 * that happens on the way in and out, short of the transfer itself.
 */
final class ApiClientTest extends TestCase
{
    // ---------------------------------------------------------------- query

    /**
     * @return iterable<string, array{array<string, mixed>, string}>
     */
    public static function queries(): iterable
    {
        yield 'empty' => [[], ''];
        yield 'nulls are skipped' => [['a' => null, 'b' => 1], 'b=1'];
        yield 'booleans become true/false' => [['x' => true, 'y' => false], 'x=true&y=false'];
        yield 'enums use their backing value' => [['kind' => PhpVersion::Php84], 'kind=php84'];
        yield 'arrays repeat the key' => [['roles' => ['a', 'b']], 'roles=a&roles=b'];
        yield 'enum arrays repeat the key' => [
            ['roles' => [ServerRole::Application, ServerRole::Email]],
            'roles=application&roles=email',
        ];
        yield 'an empty array yields nothing' => [['roles' => []], ''];
        yield 'values are encoded' => [['search' => 'a b&c'], 'search=a%20b%26c'];
        yield 'keys are encoded' => [['a key' => 'v'], 'a%20key=v'];
        yield 'zero is kept' => [['offset' => 0], 'offset=0'];
        yield 'an empty string is kept' => [['search' => ''], 'search='];
        yield 'floats are stringified' => [['size' => 1.5], 'size=1.5'];
    }

    /**
     * @param array<string, mixed> $query
     */
    #[DataProvider('queries')]
    public function testBuildQuery(array $query, string $expected): void
    {
        self::assertSame($expected, $this->call('buildQuery', $query));
    }

    // --------------------------------------------------------------- decode

    /**
     * @return iterable<string, array{string, mixed}>
     */
    public static function bodies(): iterable
    {
        yield 'an empty body decodes to null' => ['', null];
        yield 'whitespace decodes to null' => ["\n  \t", null];
        yield 'an object becomes an array' => ['{"id":"x"}', ['id' => 'x']];
        yield 'a list stays a list' => ['[1,2]', [1, 2]];
        yield 'a quoted string is unwrapped' => ['"12.25.4"', '12.25.4'];
        yield 'null decodes to null' => ['null', null];
        yield 'a bare boolean is kept' => ['false', false];
        yield 'a bare number is kept' => ['42', 42];
        // Some endpoints answer with an unquoted string, which is not valid JSON.
        yield 'a bare unquoted string falls back to text' => ['12.25.4-rc', '12.25.4-rc'];
        yield 'the fallback trims quotes and whitespace' => ["  \"ok\" \n", 'ok'];
    }

    #[DataProvider('bodies')]
    public function testDecode(string $rawBody, mixed $expected): void
    {
        self::assertSame($expected, $this->call('decode', $rawBody));
    }

    // -------------------------------------------------------------- headers

    public function testParseHeadersLowercasesNamesAndTrimsValues(): void
    {
        $raw = "HTTP/1.1 302 Found\r\nContent-Type: application/json\r\nLocation:  https://example.test/sso \r\n\r\n";

        self::assertSame(
            ['content-type' => 'application/json', 'location' => 'https://example.test/sso'],
            self::parseHeaders($raw),
        );
    }

    public function testParseHeadersKeepsColonsInTheValue(): void
    {
        $headers = self::parseHeaders("Location: https://example.test:8443/a\r\n");

        self::assertSame(['location' => 'https://example.test:8443/a'], $headers);
    }

    public function testParseHeadersIgnoresLinesWithoutAColon(): void
    {
        self::assertSame([], self::parseHeaders("HTTP/1.1 200 OK\r\n\r\n"));
    }

    // ----------------------------------------------------------------- body

    public function testNullBodySendsNothingAndSetsNoContentType(): void
    {
        $headers = [];

        self::assertNull($this->encodeBody(null, null, $headers));
        self::assertSame([], $headers);
    }

    public function testDtoBodyIsEncodedAsJson(): void
    {
        $headers = [];
        $dto = new \GoSuccess\Enhance\DTO\NewDnsThirdPartyProvider();
        $dto->url = 'https://example.test/hook';

        self::assertSame('{"url":"https:\/\/example.test\/hook"}', $this->encodeBody($dto, null, $headers));
        self::assertSame(['Content-Type: application/json'], $headers);
    }

    public function testScalarBodyIsEncodedAsJson(): void
    {
        $headers = [];

        self::assertSame('false', $this->encodeBody(false, null, $headers));
        self::assertSame(['Content-Type: application/json'], $headers);
    }

    public function testMultipartBodyIsHandedToCurlUntouched(): void
    {
        $headers = [];
        $body = ['file' => 'payload'];

        // cURL derives the boundary itself, so no Content-Type may be set.
        self::assertSame($body, $this->encodeBody($body, 'multipart/form-data', $headers));
        self::assertSame([], $headers);
    }

    public function testRawBodyKeepsTheGivenContentType(): void
    {
        $headers = [];

        self::assertSame('binary', $this->encodeBody('binary', 'application/gzip', $headers));
        self::assertSame(['Content-Type: application/gzip'], $headers);
    }

    // -------------------------------------------------------------- message

    /**
     * @return iterable<string, array{mixed, string}>
     */
    public static function errorBodies(): iterable
    {
        yield 'message wins' => [['message' => 'a', 'error' => 'b'], 'a'];
        yield 'error is used next' => [['error' => 'b', 'detail' => 'c'], 'b'];
        yield 'detail is the last key tried' => [['detail' => 'c'], 'c'];
        yield 'a bare string body is used' => ['plain failure', 'plain failure'];
        yield 'non-string values are ignored' => [['message' => ['nested']], 'Enhance API returned HTTP 400'];
        yield 'an empty body falls back' => [null, 'Enhance API returned HTTP 400'];
    }

    #[DataProvider('errorBodies')]
    public function testMessageFor(mixed $decoded, string $expected): void
    {
        self::assertSame($expected, $this->call('messageFor', new Response(400, $decoded, '')));
    }

    // ---------------------------------------------------------------- retry

    /**
     * @return iterable<string, array{int, int}>
     */
    public static function backoffAttempts(): iterable
    {
        yield 'first retry waits 100ms' => [1, 100_000];
        yield 'second retry waits 200ms' => [2, 200_000];
        yield 'third retry waits 400ms' => [3, 400_000];
    }

    #[DataProvider('backoffAttempts')]
    public function testBackoffGrowsExponentiallyWithoutRetryAfter(int $attempt, int $expected): void
    {
        self::assertSame($expected, $this->call('retryDelay', $attempt, new Response(500, null, '')));
    }

    public function testRetryAfterInSecondsIsHonored(): void
    {
        $response = new Response(429, null, '', ['retry-after' => '5']);

        self::assertSame(5_000_000, $this->call('retryDelay', 1, $response));
    }

    public function testRetryAfterIsCappedAtAMinute(): void
    {
        $response = new Response(429, null, '', ['retry-after' => '3600']);

        self::assertSame(60_000_000, $this->call('retryDelay', 1, $response));
    }

    public function testRetryAfterAsAnHttpDateIsHonored(): void
    {
        $response = new Response(429, null, '', [
            'retry-after' => gmdate('D, d M Y H:i:s \G\M\T', time() + 30),
        ]);

        $delay = $this->call('retryDelay', 1, $response);

        self::assertIsInt($delay);
        // A second may elapse between building the header and reading it.
        self::assertGreaterThanOrEqual(29_000_000, $delay);
        self::assertLessThanOrEqual(30_000_000, $delay);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function uselessRetryAfterValues(): iterable
    {
        yield 'a date in the past' => [gmdate('D, d M Y H:i:s \G\M\T', time() - 60)];
        yield 'zero seconds' => ['0'];
        yield 'garbage' => ['soon'];
    }

    #[DataProvider('uselessRetryAfterValues')]
    public function testUnusableRetryAfterFallsBackToBackoff(string $retryAfter): void
    {
        $response = new Response(429, null, '', ['retry-after' => $retryAfter]);

        self::assertSame(100_000, $this->call('retryDelay', 1, $response));
    }

    /**
     * @return iterable<string, array{int, bool}>
     */
    public static function statuses(): iterable
    {
        yield '200 is final' => [200, false];
        yield '404 is final' => [404, false];
        yield '429 is retryable' => [429, true];
        yield '500 is retryable' => [500, true];
        yield '503 is retryable' => [503, true];
    }

    #[DataProvider('statuses')]
    public function testIsRetryable(int $status, bool $expected): void
    {
        self::assertSame($expected, $this->call('isRetryable', $status));
    }

    // --------------------------------------------------------------- helper

    private function client(): ApiClient
    {
        return new ApiClient(new Configuration('https://example.test/api', 'org', 'token'));
    }

    /**
     * @return array<string, string>
     */
    private static function parseHeaders(string $raw): array
    {
        /** @var array<string, string> */
        return new ReflectionMethod(CurlTransport::class, 'parseHeaders')->invoke(null, $raw);
    }

    private function call(string $method, mixed ...$args): mixed
    {
        return new ReflectionMethod(ApiClient::class, $method)->invokeArgs($this->client(), $args);
    }

    /**
     * @param list<string> $headers Passed by reference, as the client appends the Content-Type here
     * @return string|array<string, mixed>|null
     */
    private function encodeBody(mixed $body, ?string $contentType, array &$headers): string|array|null
    {
        $args = [$body, $contentType, &$headers];

        /** @var string|array<string, mixed>|null */
        return new ReflectionMethod(ApiClient::class, 'encodeBody')->invokeArgs($this->client(), $args);
    }
}
