<?php

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DB
{
    private Connection $connection;

    public function __construct(protected array $config)
    {
        // $defaultOptions = [
        //     PDO::ATTR_EMULATE_PREPARES => false,
        //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // ];

        // $connectionParams = [
        //     'dbname' => $config['database'],
        //     'user' => $config['user'],
        //     'password' => $config['password'],
        //     'host' => $config['host'],
        //     'driver' => $config['driver'] ?? 'pdo_mysql',
        // ];
        $this->connection = DriverManager::getConnection($config);

        // try {
        //     $this->pdo = new PDO(
        //         $config['driver'].':host=' . $config['host'] . ';dbname=' . $config['database'],
        //         $config['user'],
        //         $config['password'],
        //         $config['options'] ?? $defaultOptions,
        //     );

        // } catch (\PDOException $e) {
        //     throw new \PDOException($e->getMessage(), (int) $e->getCode());
        // }
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->connection, $name], $arguments);
    }
}
