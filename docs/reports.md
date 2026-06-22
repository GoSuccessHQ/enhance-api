# ReportsResource

Accessed via `$enhance->reports`.

| Method | Route |
| ------ | ----- |
| [`getLoginPolicyBlockedIps`](#getloginpolicyblockedips) | `GET /reports/orchd/login-policy/blocked-ips` |
| [`getLoginPolicyBlockedLogins`](#getloginpolicyblockedlogins) | `GET /reports/orchd/login-policy/blocked-logins` |

## getLoginPolicyBlockedIps

Get blocked ips

`GET /reports/orchd/login-policy/blocked-ips`

```php
$result = $enhance->reports->getLoginPolicyBlockedIps();
```

## getLoginPolicyBlockedLogins

Get blocked logins

`GET /reports/orchd/login-policy/blocked-logins`

```php
$result = $enhance->reports->getLoginPolicyBlockedLogins();
```

