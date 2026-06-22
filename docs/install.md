# InstallResource

Accessed via `$enhance->install`.

| Method | Route |
| ------ | ----- |
| [`orchdStatus`](#orchdstatus) | `GET /status` |
| [`orchdVersion`](#orchdversion) | `GET /version` |

## orchdStatus

Get the readiness status of the orchd service

`GET /status`

```php
$result = $enhance->install->orchdStatus();
```

## orchdVersion

Get the SemVer of the API service

`GET /version`

```php
$result = $enhance->install->orchdVersion();
```

