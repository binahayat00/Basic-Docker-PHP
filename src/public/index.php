<?php

declare(strict_types=1);

use App\Router;
use App\App;
use App\Config;
use App\Container;
use App\Controllers\{
    HomeController,
    InvoicesController,
    TransactionController,
    GeneratorExampleController,
};

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$container = new Container();
$router = new Router($container);

$router->registerRoutesFromControllerAttribuutes(
    [
        HomeController::class,
        InvoicesController::class,
        TransactionController::class,
        GeneratorExampleController::class,
    ]
);
// $router->get('/', [HomeController::class, 'index'])
//     ->post('/upload', [HomeController::class, 'upload'])
//     ->get('/invoices', [InvoicesController::class, 'index'])
//     ->get('/invoices/create', [InvoicesController::class, 'create'])
//     ->post('/invoices/create', [InvoicesController::class, 'store'])
//     ->get('/transactions', [TransactionController::class, 'index'])
//     ->get('/generator/example', [GeneratorExampleController::class,'index'])
// ;


echo (
    new App(
        $container,
        $router,
        [
            'uri' => $_SERVER['REQUEST_URI'],
            'method' => $_SERVER['REQUEST_METHOD']
        ],
        new Config($_ENV)
    )
)->run();