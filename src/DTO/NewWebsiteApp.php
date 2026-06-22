<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\DTO;

use GoSuccess\Enhance\Base\AbstractDto;
use GoSuccess\Enhance\Enum\WebsiteAppKind;

/**
 * DTO for the NewWebsiteApp schema.
 */
class NewWebsiteApp extends AbstractDto
{
    public ?WebsiteAppKind $app = null;

    public ?string $version = null;

    public ?string $path = null;

    /** This username is going to be the username of the initial WP user with which the user can login to the WP admin. This is equivalent to going to `wp-admin/install.php` and performing the install from there. */
    public ?string $adminUsername = null;

    /** Complements the admin username. Provide unhashed password. */
    public ?string $adminPassword = null;

    /** Sets the admin email address, required by some applications. */
    public ?string $adminEmail = null;

    /** Install on a specific domain within this website. Will default to use the primary domain. */
    public ?string $domainId = null;
}
