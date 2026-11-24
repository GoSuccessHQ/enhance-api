<?php

declare(strict_types=1);

/**
 * Refreshes the committed snapshot of the Enhance OpenAPI specification.
 *
 * Enhance publishes the specification as YAML at the URL below; the API
 * reference at https://apidocs.enhance.com renders the same file. It is stored
 * verbatim under resources/specs/, so a refresh shows up as a readable diff.
 *
 * The scheduled workflow .github/workflows/spec-drift.yml runs this script and
 * fails when the snapshot changed. After a refresh, tests/Unit/SpecTest.php
 * names every operation, query parameter, schema property and enum case the
 * client does not cover yet.
 *
 * Usage:
 *   php tools/fetch-spec.php
 */

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/../vendor/autoload.php';

const SPEC_URL = 'https://apidocs.enhance.com/spec/oas3-api.yaml';
const SNAPSHOT = __DIR__ . '/../resources/specs/oas3-api.yaml';

$context = stream_context_create(['http' => [
    'timeout' => 30,
    'user_agent' => 'gosuccess/enhance-api tools/fetch-spec.php',
    'ignore_errors' => true,
]]);

$yaml = @file_get_contents(SPEC_URL, false, $context);
// Redirects are followed and their headers kept, so the last status line is the one of the response returned.
$status = 0;

foreach (http_get_last_response_headers() ?? [] as $header) {
    if (preg_match('~^HTTP/\S+ (\d{3})~', $header, $match) === 1) {
        $status = (int)$match[1];
    }
}

if ($yaml === false || $status !== 200) {
    fwrite(STDERR, 'Failed to download ' . SPEC_URL . ($status !== 0 ? " (HTTP {$status})" : '') . "\n");

    exit(1);
}

try {
    $spec = Yaml::parse($yaml);
} catch (ParseException $e) {
    fwrite(STDERR, "The downloaded specification is not valid YAML: {$e->getMessage()}\n");

    exit(1);
}

if (! \is_array($spec) || ! isset($spec['openapi'], $spec['info']['version'], $spec['paths'])) {
    fwrite(STDERR, "The downloaded file does not look like an OpenAPI specification.\n");

    exit(1);
}

$changed = ! is_file(SNAPSHOT) || file_get_contents(SNAPSHOT) !== $yaml;
file_put_contents(SNAPSHOT, $yaml);

echo 'wrote resources/specs/oas3-api.yaml (version ' . $spec['info']['version'] . ', ' . ($changed ? 'changed' : 'unchanged') . ")\n";
