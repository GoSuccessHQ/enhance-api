<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * DTO for the OpenclawProviderKeys schema.
 */
class OpenclawProviderKeys extends AbstractDto
{
    /** API key for openAi */
    public ?string $openAi = null;

    /** API key for xAI */
    public ?string $xAi = null;

    /** API key for Anthropic */
    public ?string $anthropic = null;

    /** API key for Gemini */
    public ?string $gemini = null;

    /** API key for Openrouter */
    public ?string $openrouter = null;
}
