<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Tests\Unit;

use GoSuccess\Enhance\DTO\Plan;
use GoSuccess\Enhance\Enum\ResourceName;
use PHPUnit\Framework\TestCase;

/**
 * Resources as the panel returns them (measured on 2026-10-28): `processes` is part of every plan.
 */
final class PlanResourcesTest extends TestCase
{
    public function testHydratesTheProcessesResource(): void
    {
        $plan = Plan::fromArray(['id' => 4, 'resources' => [['name' => 'processes', 'total' => 20], ['name' => 'diskspace', 'total' => null]]]);

        self::assertNotNull($plan->resources);
        self::assertSame(ResourceName::Processes, $plan->resources[0]->name);
        self::assertSame(20, $plan->resources[0]->total);
        self::assertNull($plan->resources[1]->total);
    }
}
