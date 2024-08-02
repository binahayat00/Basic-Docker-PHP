<?php

namespace App;

/**
 * @property-read ?array $db
 * @property-read ?array $mailer
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
            ]
        ];
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }

}
