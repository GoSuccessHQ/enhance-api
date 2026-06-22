<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;

/**
 * If this object is present, the website's .htaccess will have a new set of rules which redirect all secondary domains to this primary domain with 301 header. If this object is missing, any existing rules will be removed.
 */
class CanonicalRedirect extends AbstractDto
{
    /** Whether to put www to the url which is being redirected to. In .htaccess syntax: `http://www.example.com/$1` */
    public ?bool $useWww = null;

    /** Whether to put www to the url which is being redirected to. In .htaccess syntax: `https://example.com/$1` */
    public ?bool $useHttps = null;
}
