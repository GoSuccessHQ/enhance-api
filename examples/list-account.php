<?php

declare(strict_types=1);

/**
 * Read-only overview of the configured organization.
 *
 *   php examples/list-account.php
 */

use GoSuccess\Enhance\Enhance;

/** @var Enhance $enhance */
$enhance = require __DIR__ . '/bootstrap.php';

echo 'API version: ' . $enhance->install->orchdVersion() . "\n";
echo 'API status:  ' . $enhance->install->orchdStatus() . "\n\n";

$org = $enhance->orgs->getOrg();
echo "Organization: {$org?->name} (status: {$org?->status?->value}, websites: {$org?->websitesCount})\n\n";

$plans = $enhance->plans->getPlans()?->items ?? [];
echo 'Plans (' . count($plans) . "):\n";
foreach ($plans as $plan) {
    echo "  #{$plan->id}  {$plan->name}\n";
}

$customers = $enhance->customers->getOrgCustomers()?->items ?? [];
echo "\nCustomers (" . count($customers) . "):\n";
foreach ($customers as $customer) {
    echo "  {$customer->id}  {$customer->name}\n";
}

$websites = $enhance->websites->getWebsites(limit: 20)?->items ?? [];
echo "\nWebsites (" . count($websites) . "):\n";
foreach ($websites as $website) {
    $domain = is_object($website->domain) ? ($website->domain->domain ?? '?') : $website->domain;
    echo "  {$website->id}  {$domain}  ({$website->status?->value})\n";
}
