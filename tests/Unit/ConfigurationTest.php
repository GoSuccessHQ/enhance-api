<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\Client\Configuration;
use PHPUnit\Framework\TestCase;

final class ConfigurationTest extends TestCase
{
    public function testTrimsTrailingSlashFromHost(): void
    {
        $config = new Configuration('https://cp.example.com/api/', 'org', 'token');

        self::assertSame('https://cp.example.com/api', $config->host);
    }

    public function testEnablesSslVerificationByDefault(): void
    {
        $config = new Configuration('https://cp.example.com/api', 'org', 'token');

        self::assertTrue($config->verifySsl);
        self::assertSame(30, $config->timeout);
        self::assertSame(2, $config->maxRetries);
    }

    public function testRejectsEmptyHost(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $config = new Configuration('', 'org', 'token');
        self::fail('Expected InvalidArgumentException, got ' . $config::class);
    }

    public function testRejectsEmptyAccessToken(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $config = new Configuration('https://cp.example.com/api', 'org', '');
        self::fail('Expected InvalidArgumentException, got ' . $config::class);
    }

    public function testRejectsNonPositiveTimeout(): void
    {
        $config = new Configuration('https://cp.example.com/api', 'org', 'token');

        $this->expectException(\InvalidArgumentException::class);

        $config->timeout = 0;
    }
}
