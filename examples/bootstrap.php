<?php

declare(strict_types=1);

/**
 * Shared bootstrap for the example scripts.
 *
 * Reads credentials from environment variables and returns a configured
 * Enhance client. Never hard-code access tokens in source files.
 *
 *   ENHANCE_HOST          e.g. https://control.example.com/api
 *   ENHANCE_ORG_ID        your organization uuid
 *   ENHANCE_ACCESS_TOKEN  your access token
 *
 * Usage:
 *
 *   $enhance = require __DIR__ . '/bootstrap.php';
 */

use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Enhance;

require dirname(__DIR__) . '/vendor/autoload.php';

$host = getenv('ENHANCE_HOST') ?: '';
$orgId = getenv('ENHANCE_ORG_ID') ?: '';
$token = getenv('ENHANCE_ACCESS_TOKEN') ?: '';

if ($host === '' || $orgId === '' || $token === '') {
    fwrite(STDERR, "Missing configuration. Please set:\n");
    fwrite(STDERR, "  ENHANCE_HOST          (e.g. https://control.example.com/api)\n");
    fwrite(STDERR, "  ENHANCE_ORG_ID        (organization uuid)\n");
    fwrite(STDERR, "  ENHANCE_ACCESS_TOKEN  (access token)\n");

    exit(1);
}

return new Enhance(new Configuration($host, $orgId, $token));
