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
                'driver' => $env['DB_DRIVER'] ?? 'pdo_mysql',
                'host' => $env['DB_HOST'],
                'dbname' => $env['DB_DATABASE'],
                'user' => $env['DB_USER'],
                'password' => $env['DB_PASSWORD'],
            ],
            'mailer' => [
                'dsn' => $env['MAILER_DSN'] ??'',
            ]
        ];
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }

}
