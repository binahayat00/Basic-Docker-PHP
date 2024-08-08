<?php

namespace App;

/**
 * @property-read ?array $app
 * @property-read ?array $db
 * @property-read ?array $mailer
 * @property-read ?array $apiKeys
 * @property-read ?string $environment
 */
class Config
{
    protected $config = [];
    public function __construct(array $env = [])
    {
        $this->config = [
            'app' => [
                'name' => $env['APP_NAME'] ?? '',
                'version' => $env['APP_VERSION'] ?? '',
            ],
            'db' => [
                'eloquent' =>
                    [
                        'driver' => $env['DB_DRIVER'] ?? 'mysql',
                        'host' => $env['DB_HOST'],
                        'database' => $env['DB_DATABASE'],
                        'username' => $env['DB_USER'],
                        'password' => $env['DB_PASSWORD'],
                        'charset' => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                        'prefix' => '',
                    ],
                'doctrine' =>
                    [
                        'driver' => $env['DB_DRIVER'] ?? 'mysql',
                        'host' => $env['DB_HOST'],
                        'dbname' => $env['DB_DATABASE'],
                        'user' => $env['DB_USER'],
                        'password' => $env['DB_PASSWORD'],
                    ],
            ],
            'mailer' => [
                'dsn' => $env['MAILER_DSN'] ?? '',
            ],
            'apiKeys' => [
                'emailable' => $env['EMAILABLE_API_KEY'] ?? '',
                'abstract_api_email_validation' => $env['ABSTRACT_API_EMAIL_VALIDATION_API_KEY'] ?? '',
            ],
            'environment' => $env['APP_ENVIRONMENT'] ?? 'production',
        ];
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }

}
