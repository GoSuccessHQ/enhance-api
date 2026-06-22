# Enhance API

A modern, dependency-free PHP client for the [Enhance](https://enhance.com) control panel API.

- **Vanilla** – zero runtime dependencies, only the `curl` and `json` extensions.
- **Complete** – all 470 operations across 33 resources, covering the full Enhance API (v12.23.0).
- **Type-safe** – typed DTOs, enums, and resource methods built on PHP 8.4 features (property hooks, `readonly`, backed enums).

## Requirements

- PHP 8.4 or higher
- `ext-curl`, `ext-json`

## Installation

```bash
composer require gosuccess/enhance-api
```

## Quick start

```php
use GoSuccess\Enhance\Enhance;

$enhance = Enhance::create(
    host: 'https://cp.example.com/api',
    orgId: 'your-organization-uuid',
    accessToken: 'your-access-token',
);

// Read the API version
echo $enhance->install->orchdVersion();

// List the organization's plans (uses the configured organization id)
$plans = $enhance->plans->getPlans();
```

Every API section is exposed as a resource on the `Enhance` object, e.g.
`$enhance->websites`, `$enhance->servers`, `$enhance->orgs`, `$enhance->plans`,
`$enhance->subscriptions`, `$enhance->domains`, `$enhance->dns`,
`$enhance->emails`, `$enhance->backups`, `$enhance->ssl`, and so on.

## Documentation & examples

- **[docs/](docs/README.md)** – one reference page per resource, listing every
  method with its route, parameters, and a usage example.
- **[examples/](examples/README.md)** – runnable scripts (account overview,
  error handling, a full create/read/delete lifecycle).

## Working with DTOs

Request bodies are typed DTOs; only the properties you set are sent. Responses
are hydrated into DTOs automatically.

```php
use GoSuccess\Enhance\DTO\NewWebsite;
use GoSuccess\Enhance\Enum\PhpVersion;
use GoSuccess\Enhance\Enum\WebsiteKind;

$website = new NewWebsite();
$website->domain = 'example.test';
$website->phpVersion = PhpVersion::Php84;

$created = $enhance->websites->createWebsite($website, WebsiteKind::Normal);

echo $created->id; // NewResourceUuid::$id
```

By default, properties left as `null` are omitted from the request body. To
clear a field via an update endpoint, mark it with `setNull()` so it is sent as
an explicit `null`:

```php
$update = new UpdateWebsite();
$update->setNull('phpVersion');

$enhance->websites->updateWebsite($update, $websiteId);
```

### The organization id

Most endpoints are scoped to an organization. The `orgId` you pass to
`Enhance::create()` is used by default, so you can omit it. Pass it explicitly
to target a different organization (e.g. as an MO managing customers):

```php
$enhance->websites->getWebsites();                        // configured organization
$enhance->websites->getWebsites(orgId: 'other-org-uuid'); // another organization
```

## Configuration

`Enhance::create()` covers the common case. For finer control, build a
`Configuration` and pass it to the constructor:

```php
use GoSuccess\Enhance\Enhance;
use GoSuccess\Enhance\Client\Configuration;

$config = new Configuration('https://cp.example.com/api', 'org-uuid', 'access-token');
$config->timeout = 60;     // request timeout in seconds (default 30)
$config->maxRetries = 3;   // retries for transient failures (default 2)
$config->verifySsl = true; // TLS verification (enabled by default)

$enhance = new Enhance($config);
```

## Error handling

Non-2xx responses throw a typed exception. All of them extend
`GoSuccess\Enhance\Exception\ApiException`, which carries the status code and
response body as context.

```php
use GoSuccess\Enhance\Exception\ApiException;
use GoSuccess\Enhance\Exception\NotFoundException;

try {
    $plan = $enhance->plans->getPlan(123);
} catch (NotFoundException $e) {
    // 404
} catch (ApiException $e) {
    echo $e->getMessage();
    $context = $e->getContext(); // ['status' => int, 'body' => mixed]
}
```

| Status | Exception |
| ------ | --------- |
| 400 | `BadRequestException` |
| 401 | `UnauthorizedException` |
| 403 | `ForbiddenException` |
| 404 | `NotFoundException` |
| 409 | `ConflictException` |
| 429 | `RateLimitException` |
| 5xx | `ServerException` |
| transport error | `RequestException` |

## Custom HTTP client

The client talks to the API through `GoSuccess\Enhance\Contract\HttpClientInterface`.
The default implementation (`ApiClient`) uses cURL, but you can inject your own —
useful for testing or custom transports:

```php
$enhance = new Enhance($config, $myHttpClient);
```

## Architecture

```
src/
  Enhance.php          Entry point, one resource per API section
  Client/              Configuration and the cURL ApiClient
  Contract/            HttpClientInterface
  Http/                Immutable Response
  Resource/            33 resources (470 methods)
  DTO/                 360 hydratable data transfer objects
  Enum/                66 enums + HttpMethod/HttpStatusCode
  Exception/           Typed exception hierarchy
  Base/                AbstractResource, AbstractDto
  Attribute/           ArrayItemType
```

## Development

The `Resource`, `DTO`, and `Enum` classes were originally derived from the
Enhance OpenAPI specification (v12.23.0) and are now maintained by hand.

```bash
composer cs:fix       # apply coding standards
composer analyse      # PHPStan
composer test         # PHPUnit
composer check        # all of the above
```

## License

MIT
