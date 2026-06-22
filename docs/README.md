# API Reference

One document per resource. Each method lists its route, parameters, and a usage example.

All examples assume a configured client:

```php
use GoSuccess\Enhance\Enhance;

$enhance = Enhance::create('https://your-panel/api', 'org-id', 'access-token');
```

## Resources

- [AppsResource](apps.md) — `$enhance->apps` (15 methods)
- [BackupsResource](backups.md) — `$enhance->backups` (12 methods)
- [BrandingResource](branding.md) — `$enhance->branding` (21 methods)
- [CustomersResource](customers.md) — `$enhance->customers` (2 methods)
- [DnsResource](dns.md) — `$enhance->dns` (14 methods)
- [DomainsResource](domains.md) — `$enhance->domains` (13 methods)
- [EmailClientResource](emailClient.md) — `$enhance->emailClient` (8 methods)
- [EmailsResource](emails.md) — `$enhance->emails` (18 methods)
- [FtpResource](ftp.md) — `$enhance->ftp` (4 methods)
- [GeneralResource](general.md) — `$enhance->general` (1 methods)
- [ImportersResource](importers.md) — `$enhance->importers` (19 methods)
- [InstallResource](install.md) — `$enhance->install` (2 methods)
- [InvitesResource](invites.md) — `$enhance->invites` (3 methods)
- [JoomlaResource](joomla.md) — `$enhance->joomla` (7 methods)
- [LetsencryptResource](letsencrypt.md) — `$enhance->letsencrypt` (3 methods)
- [LicenceResource](licence.md) — `$enhance->licence` (2 methods)
- [LoginsResource](logins.md) — `$enhance->logins` (24 methods)
- [MembersResource](members.md) — `$enhance->members` (10 methods)
- [MetricsResource](metrics.md) — `$enhance->metrics` (1 methods)
- [MigrationsResource](migrations.md) — `$enhance->migrations` (6 methods)
- [MysqlResource](mysql.md) — `$enhance->mysql` (13 methods)
- [OrgsResource](orgs.md) — `$enhance->orgs` (13 methods)
- [OwnerResource](owner.md) — `$enhance->owner` (2 methods)
- [PlansResource](plans.md) — `$enhance->plans` (12 methods)
- [PostgresqlResource](postgresql.md) — `$enhance->postgresql` (9 methods)
- [ReportsResource](reports.md) — `$enhance->reports` (2 methods)
- [ServersResource](servers.md) — `$enhance->servers` (82 methods)
- [SettingsResource](settings.md) — `$enhance->settings` (35 methods)
- [SslResource](ssl.md) — `$enhance->ssl` (5 methods)
- [SubscriptionsResource](subscriptions.md) — `$enhance->subscriptions` (8 methods)
- [TagsResource](tags.md) — `$enhance->tags` (2 methods)
- [WebsitesResource](websites.md) — `$enhance->websites` (71 methods)
- [WordpressResource](wordpress.md) — `$enhance->wordpress` (31 methods)
