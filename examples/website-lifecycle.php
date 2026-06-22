<?php

declare(strict_types=1);

/**
 * Full write lifecycle: create a customer, create a website under it, read it
 * back, then delete everything again. Creates only new resources and removes
 * them; it never touches existing data.
 *
 * This script performs writes, so it is opt-in. Run it with:
 *
 *   ENHANCE_ALLOW_WRITE=1 php examples/website-lifecycle.php
 */

use GoSuccess\Enhance\DTO\NewCustomer;
use GoSuccess\Enhance\DTO\NewWebsite;
use GoSuccess\Enhance\Enhance;
use GoSuccess\Enhance\Exception\ApiException;

/** @var Enhance $enhance */
$enhance = require __DIR__ . '/bootstrap.php';

if (getenv('ENHANCE_ALLOW_WRITE') !== '1') {
    fwrite(STDERR, "This example creates and deletes resources. Re-run with ENHANCE_ALLOW_WRITE=1 to proceed.\n");

    exit(1);
}

$suffix = (string) time();
$customerOrgId = null;
$websiteId = null;

try {
    // 1) Create a new customer organization.
    $newCustomer = new NewCustomer();
    $newCustomer->name = "Example Customer {$suffix}";
    $customerOrgId = $enhance->customers->createCustomer($newCustomer)?->id;
    echo "Created customer {$customerOrgId} ({$newCustomer->name})\n";

    if ($customerOrgId === null) {
        throw new RuntimeException('No customer id returned');
    }

    // 2) Read it back.
    $customer = $enhance->orgs->getOrg(orgId: $customerOrgId);
    echo "Read customer back: {$customer?->name} ({$customer?->status?->value})\n";

    // 3) Create a website for the customer (as a master-org admin).
    $newWebsite = new NewWebsite();
    $newWebsite->domain = "example-{$suffix}.test";
    $websiteId = $enhance->websites->createWebsite($newWebsite, orgId: $customerOrgId)?->id;
    echo "Created website {$websiteId} ({$newWebsite->domain})\n";

    // 4) List the customer's websites.
    $websites = $enhance->websites->getWebsites(orgId: $customerOrgId)?->items ?? [];
    echo 'Customer now has ' . count($websites) . " website(s)\n";
} catch (ApiException $e) {
    echo 'API error: ' . $e::class . " (HTTP {$e->getCode()}): {$e->getMessage()}\n";
} finally {
    // 5) Clean up: delete the website, then the customer (force removes everything).
    if ($websiteId !== null && $customerOrgId !== null) {
        try {
            $enhance->websites->deleteWebsite($websiteId, orgId: $customerOrgId);
            echo "Deleted website {$websiteId}\n";
        } catch (ApiException $e) {
            echo "Failed to delete website: {$e->getMessage()}\n";
        }
    }

    if ($customerOrgId !== null) {
        try {
            $enhance->orgs->deleteOrg(force: true, orgId: $customerOrgId);
            echo "Deleted customer {$customerOrgId}\n";
        } catch (ApiException $e) {
            echo "Failed to delete customer: {$e->getMessage()}\n";
        }
    }
}
