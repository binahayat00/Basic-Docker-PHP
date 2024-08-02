<?php

declare(strict_types=1);

use App\Config;
use App\Entity\Invoice;
use App\Enums\InvoiceStatus;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once __DIR__ ."/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$params = (new Config($_ENV))->db;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__."/Entity"),
    isDevMode: true,
);

$connection = DriverManager::getConnection($params, $config);

$entityManager = new EntityManager(
    $connection,
    $config
);

// $queryBuilder = $entityManager->createQueryBuilder();

// $query = $queryBuilder
//     ->select('i.createdAt', 'i.amount')
//     ->from(Invoice::class,'i')
//     ->where('i.amount > :amount')
//     ->setParameter('amount', 40)
//     ->orderBy('i.createdAt','DESC')
//     ->getQuery();

// var_dump($query->getResult());

$invoice = (new Invoice())
    ->setAmount(45)
    ->setInvoiceNumber('1')
    ->setStatus(InvoiceStatus::PENDING);

$entityManager->persist($invoice);

$entityManager->flush();