<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Attribute;

use Attribute;

/**
 * Declares the element type of an array property so that DTO hydration
 * can convert each item into the correct scalar, enum, or DTO instance.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
final class ArrayItemType
{
    /**
     * @param string $type Item type: 'string', 'int', 'float', 'bool', 'enum', 'dto', or 'mixed'
     * @param class-string|null $class Fully qualified class name for 'enum' and 'dto' items
     */
    public function __construct(
        public string $type,
        public ?string $class = null,
    ) {
    }
}
