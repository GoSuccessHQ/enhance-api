# Examples

Runnable scripts demonstrating the client. They read credentials from
environment variables, so nothing sensitive is stored in the repository.

## Configuration

```bash
export ENHANCE_HOST='https://control.example.com/api'   # note the /api suffix
export ENHANCE_ORG_ID='your-organization-uuid'
export ENHANCE_ACCESS_TOKEN='your-access-token'
```

## Scripts

| Script | Description | Writes? |
| ------ | ----------- | ------- |
| [`list-account.php`](list-account.php) | Read-only overview: version, org, plans, customers, websites | no |
| [`error-handling.php`](error-handling.php) | Demonstrates the typed exception hierarchy | no |
| [`website-lifecycle.php`](website-lifecycle.php) | Create a customer + website, read them, then delete everything | yes (opt-in) |

## Running

```bash
php examples/list-account.php
php examples/error-handling.php

# The lifecycle example creates and deletes resources, so it is opt-in:
ENHANCE_ALLOW_WRITE=1 php examples/website-lifecycle.php
```
