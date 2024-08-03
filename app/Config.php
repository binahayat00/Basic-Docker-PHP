<?php

namespace App;

/**
 * @property-read ?array $db
 * @property-read ?array $mailer
 * @property-read ?array $apiKeys
 */
class Config
{
    protected $config = [];
    public function __construct(array $env = [])
    {
        $this->config = [
            'db' => [
                'driver' => $env['DB_DRIVER'] ?? 'mysql',
                'host' => $env['DB_HOST'],
                'database' => $env['DB_DATABASE'],
                'username' => $env['DB_USER'],
                'password' => $env['DB_PASSWORD'],
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ],
            'mailer' => [
                'dsn' => $env['MAILER_DSN'] ?? '',
            ],
            'apiKeys' => [
                'emailable'=> $env['EMAILABLE_API_KEY'] ?? '',
                'abstract_api_email_validation'=> $env['ABSTRACT_API_EMAIL_VALIDATION_API_KEY'] ?? '',
            ]
        ];
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }

}
