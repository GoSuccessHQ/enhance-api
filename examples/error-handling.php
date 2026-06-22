<?php

declare(strict_types=1);

/**
 * Demonstrates the typed exception hierarchy.
 *
 *   php examples/error-handling.php
 */

use GoSuccess\Enhance\Enhance;
use GoSuccess\Enhance\Exception\ApiException;
use GoSuccess\Enhance\Exception\NotFoundException;

/** @var Enhance $enhance */
$enhance = require __DIR__ . '/bootstrap.php';

// Request a plan that almost certainly does not exist.
try {
    $plan = $enhance->plans->getPlan(999999999);

    echo "Unexpectedly found plan: {$plan?->name}\n";
} catch (NotFoundException $e) {
    echo "Caught NotFoundException (HTTP {$e->getCode()}): {$e->getMessage()}\n";
} catch (ApiException $e) {
    // Base class for every API error; carries the status code and response body.
    echo 'Caught ' . $e::class . " (HTTP {$e->getCode()})\n";
    var_export($e->getContext());
    echo "\n";
}
