<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Attribute\ArrayItemType;
use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the DirectoryTreeNode schema.
 */
class DirectoryTreeNode extends AbstractDto
{
    public ?string $name = null;

    /** The path of the file relative to the root of the home dir */
    public ?string $rel_path = null;

    public ?string $node_type = null;

    /** Size in bytes */
    public ?int $size = null;

    /** POSIX permissions */
    public ?string $permissions = null;

    public ?\DateTimeImmutable $last_modified = null;

    /**
     * Only present when type=directory
     * @var array<int, \GoSuccess\Enhance\DTO\DirectoryTreeNode>
     */
    #[ArrayItemType('dto', \GoSuccess\Enhance\DTO\DirectoryTreeNode::class)]
    public ?array $children = null;
}
