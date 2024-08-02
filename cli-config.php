<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Config;
use Dotenv\Dotenv;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

$params = (new Config($_ENV))->db;

$configORM = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . "/app/Entity"),
    isDevMode: true,
);

$connection = DriverManager::getConnection($params, $configORM);

$entityManager = new EntityManager(
    $connection,
    $configORM
);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
