<?php

declare(strict_types=1);

namespace GoSuccess\Enhance;

use GoSuccess\Enhance\Client\ApiClient;
use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Contract\HttpClientInterface;
use GoSuccess\Enhance\Http\Transport;
use GoSuccess\Enhance\Resource\AppsResource;
use GoSuccess\Enhance\Resource\BackupsResource;
use GoSuccess\Enhance\Resource\BrandingResource;
use GoSuccess\Enhance\Resource\CustomersResource;
use GoSuccess\Enhance\Resource\DnsResource;
use GoSuccess\Enhance\Resource\DomainsResource;
use GoSuccess\Enhance\Resource\EmailClientResource;
use GoSuccess\Enhance\Resource\EmailsResource;
use GoSuccess\Enhance\Resource\FtpResource;
use GoSuccess\Enhance\Resource\GeneralResource;
use GoSuccess\Enhance\Resource\ImportersResource;
use GoSuccess\Enhance\Resource\InstallResource;
use GoSuccess\Enhance\Resource\InvitesResource;
use GoSuccess\Enhance\Resource\JoomlaResource;
use GoSuccess\Enhance\Resource\LetsencryptResource;
use GoSuccess\Enhance\Resource\LicenceResource;
use GoSuccess\Enhance\Resource\LoginsResource;
use GoSuccess\Enhance\Resource\MembersResource;
use GoSuccess\Enhance\Resource\MetricsResource;
use GoSuccess\Enhance\Resource\MigrationsResource;
use GoSuccess\Enhance\Resource\MysqlResource;
use GoSuccess\Enhance\Resource\OrgsResource;
use GoSuccess\Enhance\Resource\OwnerResource;
use GoSuccess\Enhance\Resource\PlansResource;
use GoSuccess\Enhance\Resource\PostgresqlResource;
use GoSuccess\Enhance\Resource\ReportsResource;
use GoSuccess\Enhance\Resource\ServersResource;
use GoSuccess\Enhance\Resource\SettingsResource;
use GoSuccess\Enhance\Resource\SslResource;
use GoSuccess\Enhance\Resource\SubscriptionsResource;
use GoSuccess\Enhance\Resource\TagsResource;
use GoSuccess\Enhance\Resource\WebsitesResource;
use GoSuccess\Enhance\Resource\WordpressResource;

/**
 * Entry point for the Enhance API client.
 *
 * Exposes one resource per API section. Each resource groups the
 * operations of the corresponding OpenAPI tag.
 *
 * @example
 * ```php
 * $enhance = Enhance::create('https://cp.example.com/api', 'org-uuid', 'access-token');
 * $plans = $enhance->plans->getOrgPlans();
 * ```
 */
final class Enhance
{
    public readonly Configuration $config;

    private readonly HttpClientInterface $client;

    public readonly AppsResource $apps;

    public readonly BackupsResource $backups;

    public readonly BrandingResource $branding;

    public readonly CustomersResource $customers;

    public readonly DnsResource $dns;

    public readonly DomainsResource $domains;

    public readonly EmailClientResource $emailClient;

    public readonly EmailsResource $emails;

    public readonly FtpResource $ftp;

    public readonly GeneralResource $general;

    public readonly ImportersResource $importers;

    public readonly InstallResource $install;

    public readonly InvitesResource $invites;

    public readonly JoomlaResource $joomla;

    public readonly LetsencryptResource $letsencrypt;

    public readonly LicenceResource $licence;

    public readonly LoginsResource $logins;

    public readonly MembersResource $members;

    public readonly MetricsResource $metrics;

    public readonly MigrationsResource $migrations;

    public readonly MysqlResource $mysql;

    public readonly OrgsResource $orgs;

    public readonly OwnerResource $owner;

    public readonly PlansResource $plans;

    public readonly PostgresqlResource $postgresql;

    public readonly ReportsResource $reports;

    public readonly ServersResource $servers;

    public readonly SettingsResource $settings;

    public readonly SslResource $ssl;

    public readonly SubscriptionsResource $subscriptions;

    public readonly TagsResource $tags;

    public readonly WebsitesResource $websites;

    public readonly WordpressResource $wordpress;

    public function __construct(Configuration $config, ?HttpClientInterface $client = null, ?Transport $transport = null)
    {
        $this->config = $config;
        $this->client = $client ?? new ApiClient($config, $transport);

        $this->apps = new AppsResource($this->client, $this->config);
        $this->backups = new BackupsResource($this->client, $this->config);
        $this->branding = new BrandingResource($this->client, $this->config);
        $this->customers = new CustomersResource($this->client, $this->config);
        $this->dns = new DnsResource($this->client, $this->config);
        $this->domains = new DomainsResource($this->client, $this->config);
        $this->emailClient = new EmailClientResource($this->client, $this->config);
        $this->emails = new EmailsResource($this->client, $this->config);
        $this->ftp = new FtpResource($this->client, $this->config);
        $this->general = new GeneralResource($this->client, $this->config);
        $this->importers = new ImportersResource($this->client, $this->config);
        $this->install = new InstallResource($this->client, $this->config);
        $this->invites = new InvitesResource($this->client, $this->config);
        $this->joomla = new JoomlaResource($this->client, $this->config);
        $this->letsencrypt = new LetsencryptResource($this->client, $this->config);
        $this->licence = new LicenceResource($this->client, $this->config);
        $this->logins = new LoginsResource($this->client, $this->config);
        $this->members = new MembersResource($this->client, $this->config);
        $this->metrics = new MetricsResource($this->client, $this->config);
        $this->migrations = new MigrationsResource($this->client, $this->config);
        $this->mysql = new MysqlResource($this->client, $this->config);
        $this->orgs = new OrgsResource($this->client, $this->config);
        $this->owner = new OwnerResource($this->client, $this->config);
        $this->plans = new PlansResource($this->client, $this->config);
        $this->postgresql = new PostgresqlResource($this->client, $this->config);
        $this->reports = new ReportsResource($this->client, $this->config);
        $this->servers = new ServersResource($this->client, $this->config);
        $this->settings = new SettingsResource($this->client, $this->config);
        $this->ssl = new SslResource($this->client, $this->config);
        $this->subscriptions = new SubscriptionsResource($this->client, $this->config);
        $this->tags = new TagsResource($this->client, $this->config);
        $this->websites = new WebsitesResource($this->client, $this->config);
        $this->wordpress = new WordpressResource($this->client, $this->config);
    }

    /**
     * Convenience factory for the common case.
     */
    public static function create(string $host, string $orgId, string $accessToken): self
    {
        return new self(new Configuration($host, $orgId, $accessToken));
    }
}
