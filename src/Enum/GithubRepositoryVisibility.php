<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The GithubRepositoryVisibility enumeration.
 */
enum GithubRepositoryVisibility: string
{
    case Public = 'public';

    case Private = 'private';

    case Internal = 'internal';
}
