<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * The GithubLanguage enumeration.
 */
enum GithubLanguage: string
{
    case Rust = 'Rust';

    case JavaScript = 'JavaScript';

    case TypeScript = 'TypeScript';

    case Php = 'PHP';

    case Python = 'Python';

    case Ruby = 'Ruby';

    case Go = 'Go';

    case Java = 'Java';

    case C = 'C';

    case Cpp = 'C++';

    case CSharp = 'C#';

    case Swift = 'Swift';

    case Kotlin = 'Kotlin';

    case Shell = 'Shell';

    case Html = 'HTML';

    case Css = 'CSS';

    case Vue = 'Vue';

    case Dart = 'Dart';

    case ObjectiveC = 'Objective-C';

    case Unknown = 'unknown';
}
